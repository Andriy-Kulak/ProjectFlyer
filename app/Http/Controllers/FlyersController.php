<?php

namespace App\Http\Controllers;
use App\Flyer;
use App\Http;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Traits\AuthorizesUsers;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FlyersController extends Controller
{
    use AuthorizesUsers;


    /**
     * Auth checks to make sure you are logged in before making any adjustments
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        //delegating to parent controller
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        flash()->overlay('Hello World', 'this is the message');

        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {

        //persist the flyer
        //Flyer::create($request->all());

        $flyer = $this->user->publish(
            new Flyer($request->all())
        );

        //flash messaging
        flash()->success('Success!', 'Your flyer has been created.');

        //return view('pages.home');//temporary redirect the landing page
        //return redirect()->back();
        return redirect($flyer->zip . '/' . str_replace(' ', '-', $flyer->street));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        //find the new flyer
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));

    }

    /**
     * Add photo to the referenced flyer. This is triggered when User drops photo
     * in the Dropzone location.
     * @param $zip
     * @param $street
     * @param Request $request
     */
    public function addPhoto($zip, $street, Request $request){

        //confirmtion that the photo file will be in appropriate format types
        $this->validate($request, [ 'photo' => 'required|mimes:jpg,jpeg,png,bmp']);


        // if user didn't create the flyer, return with unathorized request
        if(! $this->userCreatedFlyer($request)) {
            return $this->unathorized($request);
        }

        //build up our photo instance taking the file from dropzone plugin
        $photo = $this->makePhoto($request->file('photo'));

        //Save photo and associate it with the Flyer
        Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    /**
     *
     *
     * @param UploadedFile $file
     * @return mixed
     */
    protected function makePhoto(UploadedFile $file){

        //get new photo object with current name
        return Photo::named($file->getClientOriginalName())->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
