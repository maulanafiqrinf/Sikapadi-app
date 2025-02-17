<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Client extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'image',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
