<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'tag_id', 'product_id');
    }
}
