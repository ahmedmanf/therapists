@extends('layouts.dashboard')
@section('title')
edit Therapists
@endsection
@section('content')
    <form method="POST" action="{{route('therapists_update',$data->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Name" required value="{{$data->title}}">
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="file" name="picture" class="form-control" placeholder="Picture" >
            </div>
            <div class="col-sm-2">
                <img src="{{asset('avatars/therapists/'.$data->picture)}}"
                     class="rounded-circle card-img-top shadow"
                     style="max-width: 70px; max-height: 70px;" />
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="description" placeholder="Description">{{$data->description}}</textarea>
        </div>
        <div class="form-group">
            <input type="text" name="price" class="form-control" placeholder="price" required value="{{$data->price}}">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="active" value="1" class="form-check-input" {{ $data->active == '1' ? 'checked="checked"' : '' }}>
            <label class="form-check-label">Activate</label>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
