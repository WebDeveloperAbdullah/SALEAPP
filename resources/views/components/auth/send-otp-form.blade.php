<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        {{session('error')}}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>

                    @endif
                    <br/>
                    <form action="{{route('send_otp')}}"  method="post">
                        @csrf
                    <label>Your email address</label>
                    <input id="email" name="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input type="submit" class="btn w-100 float-end bg-gradient-primary" value="Next">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>


