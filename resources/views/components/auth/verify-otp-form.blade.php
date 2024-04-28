<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>ENTER OTP CODE</h4>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session('success')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif
                    @if (session('error'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session('error')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif
                    <br/>
                    <form action="{{route('verify_otp_core')}}" method="post">
                    <label>6 Digit Code Here</label>
                    @csrf
                  {{-- <input type="hidden" name="email" value="{{session('email')}}"> --}}
                    <input id="otp" name="otp" placeholder="Code" class="form-control" type="text"/>
                    <br/>
                    <input type="submit" value="Next" class="btn w-100 float-end bg-gradient-primary">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

