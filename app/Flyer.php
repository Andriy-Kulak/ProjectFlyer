<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    /**
     * Fillable fields for a flyer.
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
    static function locatedAt($zip, $street) {
        $street = str_replace('-', ' ', $street);

        return static::where(compact('zip', 'street'))->firstorFail();
    }

    public function getPriceAttribute($price) {
        return '$' . number_format($price);
    }

    /**
     * Fetch the relationship and save photo
     *
     * @param Photo $photo
     * @return Model
     */
    public function addPhoto(Photo $photo){
        return $this->photos()->save($photo);
    }

    /**
     * A flyer is composed of many photos
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
