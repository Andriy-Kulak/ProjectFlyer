@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <!-- flyer street !-->
            <h1>{!! $flyer->street !!}</h1>
            <!-- flyer price !-->
            <h2>{!! $flyer->price !!}</h2>

            <hr>
            <!-- flyer decription !-->
            <div class="description"> {!! nl2br($flyer->description) !!}</div>
        </div>
        <div class="col-md-8 gallery">

            <!-- displaying each photo thumbnail !-->
            @foreach($flyer->photos->chunk(4) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="col-md-3 gallery__image">
                             <img src="/{{ $photo->thumbnail_path }}" alt="">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <hr>

    <h2> Add Your Photos</h2>
    <!-- Dropzone Js Plugin where users can drop their photos !-->
    <form id="addPhotosForm"
          action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}"
          method="POST"
          class="dropzone">
        {{ csrf_field() }}
    </form>

@stop

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <!-- Dropzone Js configurations for the plugin above !-->
    <script>
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, bmp'
        }
    </script>
@stop

