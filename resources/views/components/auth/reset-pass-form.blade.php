<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    @if (session('error'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session('error')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif
                    <br/>
                    <form action="{{route('reset_password_core')}}" method="post">
                        @csrf
                    <label>New Password</label>
                    <input id="password" name="password" placeholder="New Password" class="form-control" type="password" />
                    <br/>
                    <input type="hidden" name="email" value="{{session('email')}}">
                    <label>Confirm Password</label>
                    <input id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control" type="password" />
                    <br/>
                    <input type="submit" class="btn w-100 bg-gradient-primary" value="Next">

                </form>
                </div>
            </div>
        </div>
    </div>
</div>

