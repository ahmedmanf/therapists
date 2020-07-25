@extends('layouts.dashboard')
@section('title')
Manage Therapists
<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal">Add</button>
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{route('therapists_search')}}">
                @csrf
                <div class="form-row">
                    <div class="col-sm-11">
                        <label class="w-100">
                            <input class="form-control form-input shadow p-3 mb-5 bg-white rounded"
                                   placeholder="Search"
                                   type="text"
                                   id="search_input"
                                   name="search"
                            >
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-search text-white text-lg-center "></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{route('therapists_add')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="file" name="picture" class="form-control" placeholder="Picture" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="price" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="active" value="1" class="form-check-input">
                            <label class="form-check-label">Activate</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ $data->links() }}
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>description</th>
                    <th>price</th>
                    <th>picture</th>
                    <th>status</th>
                    <th>actions</th>
                    <th>created at</th>
                    <th>updated at</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($data as $one)
                <tr>
                    <td scope="row">{{$one->id}}</td>
                    <td>{{$one->title}}</td>
                    <td>{{Str::limit($one->description,25)}}</td>
                    <td>{{$one->price}} EGP</td>
                    <td>
                        <img src="{{asset('avatars/therapists/'.$one->picture)}}"
                             class="rounded-circle card-img-top shadow"
                             style="max-width: 70px; max-height: 70px;" />
                    </td>
                    <td class="text-center">
                        <input class="form-check-input"
                               type="checkbox"
                                {{ $one->active == '1' ? 'checked="checked"' : '' }}
                                disabled />
                    </td>
                    <td class="text-center">
                        <a href="{{route('therapists_edit',$one->id)}}" class="btn btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        {{ Form::open(array('method' => 'Delete',
                                            'route' => array('therapists_destroy',$one->id),
                                            'class' => 'delete-form',
                                            'onsubmit' => 'return confirm(\'Are you sure make delete operation that will be delete related reservation ?\')')) }}
                        <button type="submit"
                                title="Delete"
                                class="btn btn-danger my-2"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        {{ Form::close() }}
                    </td>
                    <td>{{$one->created_at}}</td>
                    <td>{{$one->updated_at}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">
                        <div class="alert alert-info" role="alert">No data</div>
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>description</th>
                <th>price</th>
                <th>picture</th>
                <th>status</th>
                <th>actions</th>
                <th>created at</th>
                <th>updated at</th>
            </tr>
            </tfoot>
        </table>
    </div>
    {{ $data->links() }}
@endsection
