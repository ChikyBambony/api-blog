<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Orchid\Screen\AsSource;

class Post extends Model
{

    use HasFactory, Notifiable, AsSource;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'id'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
