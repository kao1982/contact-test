<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // テーブル名が「categories」であることを明示します
    protected $table = 'categories';

    protected $fillable = [
        'content',
    ];
}