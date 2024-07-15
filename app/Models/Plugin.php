<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'version'];

    public function dependencies()
    {
        return $this->belongsToMany(Plugin::class, 'plugin_dependencies', 'plugin_id', 'dependency_id');
    }
}
