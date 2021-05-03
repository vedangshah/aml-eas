@extends('layout.main')
@section('title', 'reset-password')

@section('content')


    <div class="container">
        <div class="row m-h-100 ">
            <div class="col-md-8 col-lg-4  m-auto">
                <div class="card shadow-lg ">
                    <div class="card-body ">
                        <div class=" padding-box-2 ">
                            <div class="text-center p-b-20 pull-up-sm">

                                <div class="avatar avatar-lg">
                                    <span class="avatar-title rounded-circle bg-pink"> <i
                                                class="mdi mdi-key-change"></i> </span>
                                </div>
 
                            </div>
                            <h3 class="text-center">Reset Password</h3>
                            <form method="post" action="{{ route('forgot-user.store') }}" >
                               @csrf
                                <div class="form-group">
                                    <label>Email</label>

                                    <div class="input-group input-group-flush mb-3">
                                        <input type="email" class="form-control form-control-prepended @error('user_email') is-invalid @enderror"
                                        name="user_email"       placeholder="yourmail@example.com">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <span class=" mdi mdi-email "></span>
                                            </div>
                                        </div>
                                        @error('user_email')
													<div class="invalid-feedback">{{ $message }}</div>
									    @enderror
                                    </div>
                                    <p class="small">
                                        We will send a reset link to your registered E-Mail
                                    </p>
                                </div>


                                <div class="form-group">
                                    <button class="btn text-uppercase btn-block  btn-primary" type="submit">
                                        Reset Password
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection