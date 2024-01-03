
@extends('layouts.app')

@section('content')
   

@if ($errors->any())
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Validation errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-header">
    <h1>Create Popup</h1>
    </div>
    <div class="card-body">
    <form action="{{ route('popups.update', ['popup' => $popup->id]) }}" method="POST">
        @csrf
        @method('PUT')
<div class="input-group input-group-outline my-3">
        <input class="form-control" type="text" name="name" value="{{ $popup->name }}" placeholder="Name:" required >
        </div>
        <div class="input-group input-group-outline my-3">
        <textarea class="form-control" id="content" name="content">{!! json_decode($popup->content)!!}}</textarea>
        </div>
        
    <div class="input-group input-group-outline my-3">
            <select name="scheduled_pages[]" id="scheduled_pages[]" class="form-control" multiple>
@foreach (\App\Models\page::all() as $page)

<option value="{{$page->url}}"  @if(in_array($page->url, json_decode($popup->scheduled_pages))) 
                selected 
            @endif>{{$page->name}}</option>

@endforeach

            </select>
       
        </div>

        <div class="input-group input-group-outline my-3">
        <select class="form-control" name="type" required>
            <option  value="full_screen" {{ $popup->type == 'full_screen' ? 'selected' : '' }}>Full Screen</option>
            <option value="slide_in" {{ $popup->type== 'slide_in' ? 'selected' : '' }}>Slide In</option>
            <option value="exit_intent" {{$popup->type == 'exit_intent' ? 'selected' : '' }}>Exit Intent</option>
        </select>
            </div>
        

        <button class="btn btn-outline-primary btn-sm mb-0 me-2" type="submit">Create Popup</button>

    </form>

    </div>
</div>
    
@endsection

@section('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard-all/contents.css">
<script>
    document.addEventListener("DOMContentLoaded", function () {

ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
   })
            </script>
@endsection