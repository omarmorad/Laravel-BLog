<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
        'image'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    // Mutator for setting the image attribute
    public function setImageAttribute($value)
    {
        if ($value && is_object($value)) {
            // Delete old image if exists
            if ($this->image) {
                Storage::disk('public')->delete('images/' . $this->image);
            }
            
            // Store new image
            $filename = time() . '.' . $value->getClientOriginalExtension();
            $value->storeAs('images', $filename, 'public');
            $this->attributes['image'] = $filename;
        }
    }
    
    // Accessor for getting the image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url('images/' . $this->image) : null;
    }
    
    // Delete the image when the post is deleted
    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function($post) {
            if ($post->image) {
                Storage::disk('public')->delete('images/' . $post->image);
            }
        });
    }
}
