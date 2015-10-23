<?php

namespace App\Http\Controllers;
use App\Flyer;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;
use App\Http;
use App\Photo;


class FlyersController extends Controller
{
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
        Flyer::create($request->all());

        //flash messaging
        flash()->success('Success!', 'Your flyer has been created.');

        return redirect()->back();//temporary redirect the landing page
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
     * Apply photo to the referenced flyer.
     * @param $zip
     * @param $street
     * @param Request $request
     */
    public function addPhoto($zip, $street, Request $request){

        //confirmtion that the photo file will be in appropriate format types
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        //build up our photo instance taking the file from dropzone plugin
        $photo = Photo::fromForm($request->file('photo'));

        //adding photo to our Flyer Id
        Flyer::locatedAt($zip, $street)->addPhoto($photo);
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
