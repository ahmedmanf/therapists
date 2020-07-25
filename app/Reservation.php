<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'therapist_id',
        'time',
        'name',
        'email',
        'mobile'
    ];

    /**
     * Get therapist for this reservation
     */
    public function therapist()
    {
        return $this->belongsTo(Therapist::class,'therapist_id');
    }
}
