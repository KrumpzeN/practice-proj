<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = ['email','bike_id','quantity','total_amount', 'notified', 'delivered ',];

    protected $attributes = ['notified' => false,];

    public function bike()
{
    return $this->belongsTo(Bike::class);
}
}
