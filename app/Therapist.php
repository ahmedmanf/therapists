<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'picture',
        'price',
        'description',
        'active'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
