<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table= 'flyer_photos';
    protected $fillable = ['path'];
    protected $baseDir = 'flyers/photos';


    public function flyer(){

        return $this->belongsTo('App\Flyer');
    }

    public static function fromForm(UploadedFile $file){

        //new photo instance
        $photo = new static;

        //concatenate file name with current time to prevent duplicate entries in db
        $name = time() . $file->getClientOriginalName();

        //create path of the photo
        $photo->path = $photo->baseDir . '/' . $name;

        // move the file to new location in flyers/photos
        $file->move($photo->baseDir, $name);

        return $photo;
    }
}
