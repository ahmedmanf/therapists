@extends('layouts.dashboard')
@section('title')
Manage Reservations
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{route('reservations_search')}}">
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
                    <th>Therapist</th>
                    <th>name</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th>date</th>
                    <th>actions</th>
                    <th>created at</th>
                    <th>updated at</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($data as $one)
                <tr>
                    <td scope="row">{{$one->id}}</td>
                    <td>{{$one->therapist->title}}</td>
                    <td>{{$one->name}}</td>
                    <td>{{$one->email}}</td>
                    <td>{{$one->mobile}}</td>
                    <td>{{$one->time}}</td>
                    <td class="text-center">
                        {{ Form::open(array('method' => 'Delete',
                                            'route' => array('reservations_destroy',$one->id),
                                            'class' => 'delete-form',
                                            'onsubmit' => 'return confirm(\'Are you sure make delete operation ?\')')) }}
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
                <th>Therapist</th>
                <th>name</th>
                <th>email</th>
                <th>mobile</th>
                <th>date</th>
                <th>actions</th>
                <th>created at</th>
                <th>updated at</th>
            </tr>
            </tfoot>
        </table>
    </div>
    {{ $data->links() }}
@endsection
