@extends('layout')


@section('content')

    <div class="row">
        <div class="col-md-4">
            <!-- flyer street !-->
            <h1>{{ $flyer->street }}</h1>
            <!-- flyer price !-->
            <h2>{{ $flyer->price }}</h2>

            <hr>
            <!-- flyer decription !-->
            <div class="description"> {!! nl2br($flyer->description) !!}</div>
        </div>
        <div class="col-md-8 gallery">

            <!-- displaying each photo thumbnail !-->
            @foreach($flyer->photos->chunk(4) as $set)
                <div class="row">

                    @foreach($set as $photo)
                        <div class="col-md-3 gallery__image divbutton">

                            <a href="/{{ $photo->path }}" data-lity>
                             <img src="/{{ $photo->thumbnail_path }}" alt="">
                            </a>

                            <!-- Delete Photo button !-->
                            <form method="POST" action="/photos/{{ $photo->id }}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="display: none;">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <p><i>Click on image to expand</i></p>

            <!-- If user is signed in and accessing his flyer, only then will Dropzone be available !-->
            @if ($user && $user->owns($flyer))
                <hr>

                <h2> Add Your Photos</h2>
                <!-- Dropzone Js Plugin where users can drop their photos !-->
                <form id="addPhotosForm"
                      action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}"
                      method="POST"
                      class="dropzone">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            @endif

        </div>
    </div>

    <!-- JQuery Script to show Delete Button !-->
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('mouseenter', '.divbutton', function () {
                $(this).find(":button").show();
            }).on('mouseleave', '.divbutton', function () {
                $(this).find(":button").hide();
            });
        });
    </script>
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

