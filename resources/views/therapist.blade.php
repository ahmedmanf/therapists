<a class="float-right mr-3 mt-3 text-secondary text-lg-center" href="#" onclick="return closereservation();">
    <h3><i class="fas fa-times-circle"></i></h3>
</a>
<div class="rounded-0 mt-5">
    <div>
        <div class="col-md-5 float-left">
            <img src="{{asset('avatars/therapists/'.$data->picture)}}" class="rounded-circle card-img-top shadow" style="width: 150px; height: 150px;" />
        </div>
        <div class="col-md-7 float-left">
            <div class="mr1 text-left">
                <h5>{{$data->title}}</h5>
                <p class="text-sm-left mt-3">
                    {{$data->description}}
                </p>
                <div>
                    <span class="fa fa-star text-warning"></span>
                    <span class="fa fa-star text-warning"></span>
                    <span class="fa fa-star text-warning"></span>
                    <span class="fa fa-star text-warning"></span>
                    <span class="fa fa-star text-warning"></span>
                </div>
            </div>
        </div>
        <div class="col-md-12 float-left justify-content-center text-center">
            <button class="btn btn-success mt-2">
                60 Minutes
            </button>
            <button class="btn btn-success mt-2">
                {{$data->price}} EGP
            </button>
        </div>
        <div class="col-md-12 float-left mt-3">
            <form method="POST" action="{{route('reserve')}}">
                @csrf
                <input type="hidden" name="therapist_id" value="{{$data->id}}">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control required" name="name" id="name" placeholder="Full Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control required email" name="email" id="email" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control required" name="mobile" id="mobile" placeholder="01000000000" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="time" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control required date datepicker" name="time" id="time" placeholder="{{ date("m/d/Y") }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">
                            Book Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
