<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    /**
     * fillable fields for a flyer
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
    ];

    /**
     * Scope query to those located at a given address
     *
     * @param $query
     * @param $zip
     * @param $street
     * @return mixed
     */
    public function scopeLocatedAt($query, $zip, $street) {
        $street = str_replace('-', ' ', $street);

        return $query->where(compact('zip', 'street'));
    }

    /**
     * A flyer is composed of many photos
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
