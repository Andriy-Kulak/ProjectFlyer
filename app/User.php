<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @param $relation
     * @return bool
     */
    public function owns($relation) {
        return $relation->user_id == $this->id;
    }

    /**
     * User can have many flyers
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyers() {
        return $this->hasMany(Flyer::class);
    }

    /**
     * Will Automatically assign user_id to flyer when it is stored in db.
     * @param Flyer $flyer
     */
    public function publish(Flyer $flyer) {
        return $this->flyers()->save($flyer);
    }
}
