<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    public $timestamps =false;

    public function user() //la magia de laravel se hace por que lo indique en las migrations (linea 22 de la migrations de order)
    {
        return $this->belongsTo(user::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
