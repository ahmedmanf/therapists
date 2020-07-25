@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-sm-11">
                        <label class="w-100">
                            <input class="form-control form-input shadow p-3 mb-5 bg-white rounded"
                                   placeholder="Search"
                                   type="text"
                                   id="search_input"
                                   name="search"
                                   onkeyup="search();"
                            >
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-primary w-100" onclick="search();">
                            <i class="fa fa-search text-white text-lg-center "></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center min-vh-100" id="Therapist_html_view"></div>
    <div class="row" id="Scroll_loader_Icon" data-next-page="1" data-last-page="1" data-main-url="{{route('therapist')}}" data-from-send="page">
        <div class="col-md-12 text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>
<div id="sidebarReservation" class="bg-white position-fixed overflow-hidden h-100 justify-content-center" style="display:none; width:450px; top:0px; z-index: 9999; left: 0; right: inherit;">
</div>
<div class="modal fade mr-3 mb-3" id="MyNotify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="right: 20px; left: inherit; bottom: 20px; top: inherit; width: 200px; height: 200px;">
    <div class="modal-dialog m-0">
        <div id="NotifyContent">
        </div>
    </div>
</div>
@if (session('status'))
    <script type="text/javascript">
        setTimeout(function() {
            alertflash('success','{{ session("status") }}');
        }, 1000);
    </script>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script type="text/javascript">
            setTimeout(function() {
                alertflash('danger','{{ $error }}');
            }, 1000);
        </script>
    @endforeach
@endif
@endsection
