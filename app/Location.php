<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table='Location';
    protected $fillable=['title','description','lat','lng'];
    public $timestamps=true;
    protected $guarded='id';
}
