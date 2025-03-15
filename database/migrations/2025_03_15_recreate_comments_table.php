<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, backup any existing comments
        $comments = [];
        if (Schema::hasTable('comments')) {
            $comments = DB::table('comments')->get()->toArray();
        }

        // Drop the existing comments table
        Schema::dropIfExists('comments');

        // Create a new comments table with the correct structure
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Restore the backed up comments if any
        foreach ($comments as $comment) {
            $data = [
                'id' => $comment->id,
                'content' => $comment->content,
                'user_id' => $comment->user_id,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at,
            ];

            // Handle the commentable_id and commentable_type
            if (isset($comment->post_id)) {
                $data['commentable_id'] = $comment->post_id;
                $data['commentable_type'] = 'App\\Models\\Post';
            } elseif (isset($comment->commentable_id) && isset($comment->commentable_type)) {
                $data['commentable_id'] = $comment->commentable_id;
                $data['commentable_type'] = $comment->commentable_type;
            }

            DB::table('comments')->insert($data);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};