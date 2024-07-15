<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function thumbnail()
    {
        return $this->morphMany(File::class, 'fileable')->where('collection_name', 'thumbnail');
    }
}
