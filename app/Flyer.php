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
    public function addPhoto(Photo $photo) {
        return $this->photos()->save($photo);
    }

    /**
     * A flyer is composed of many photos
     */
    public function photos() {
        return $this->hasMany('App\Photo');
    }

    /**
     * A Flyer is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determine if the given user created the flyer.
     *
     * @param User $user
     * @return bool
     */
    public function ownedBy(User $user) {
        return $this->user_id == $user->id;
    }
}
