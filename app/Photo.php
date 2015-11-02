<?php

namespace App;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';
    protected $fillable = ['path' , 'name' , 'thumbnail_path'];
    protected $baseDir = 'flyer/photos';


    public function flyer(){
        // creates a new instance of a photo
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Build a photo instance from a file upload
     *
     * @param $name
     * @return mixed
     */
    public static function named($name){


        return (new static)->saveAs($name);

    }

    /**
     * Setting name, path, and thumbnail_path parameters for Photo instance
     *
     * @param $name
     * @return $this
     */
    protected function saveAs($name){
        //concatenate file name with current time to prevent duplicate entries in db
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path =sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;

    }

    public function move(UploadedFile $file){

        // move the file to new location in flyer/photos
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;

    }

    /**
     * Change sizing of thumbnail and save it
     *
     * @param UploadedFile $file
     */
    protected function makeThumbnail() {
        //dd('error test');
        Image::make($this->path)
        ->fit(200)
        ->save($this->thumbnail_path);
    }
}
