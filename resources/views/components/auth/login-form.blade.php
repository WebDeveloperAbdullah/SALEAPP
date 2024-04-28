<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session('success')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session('error')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif
                    <br/>

                    <form action="{{route('user_login_core')}}" method="POST">
                        @csrf
                    <input id="email" name="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" name="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>

                    <input type="submit" class="btn w-100 bg-gradient-primary" value="Next">
                </form>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/user_registration')}}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/send_otp_page')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



