<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Testimoni extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
