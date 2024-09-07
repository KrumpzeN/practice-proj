<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'name', 'availability', 'bike_brand_id', 'bike_type_id', 'article'];

    public function bikeBrand()
    {
        return $this->belongsTo(BikeBrand::class, 'bike_brand_id');
    }

    public function bikeType()
    {
        return $this->belongsTo(BikeType::class, 'bike_type_id');
    }
}
