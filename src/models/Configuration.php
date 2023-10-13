<?php

namespace LazyCode404\laravelwebinstaller\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    public $fillable = [
        'config',
        'value',
    ];
}
