<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BikeBrand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'countryName'];

    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }   

}
