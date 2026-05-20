@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-6 col-xl-5">
            <div class="card w-100  p-4 p-sm-5 shadow-lg border-0">

                <div class="text-center ">
                    <h3 class="fw-bold">Signup Form</h3>
                    <p class="text-center mb-0">It's quick and easy.</p>
                </div>

                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="fw-bold">Full Name</label>
                        <input id="fullname" name="fullname" type="text" class="form-control shadow-none border border-1 border-dark" placeholder="Enter Full name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="fw-bold">Email address</label>
                        <input id="email" name="email" type="email" class="form-control shadow-none border border-1 border-dark" placeholder="Enter Email address" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="fw-bold">Password</label>

                        <div class="input-group">
                            <input id="password" name="password" type="password" class="form-control shadow-none border border-1 border-dark" placeholder="Enter Password" required>

                            <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmpassword" class="fw-bold">Confirm Password</label>

                        <div class="input-group">
                            <input id="confirmpassword" name="confirmpassword" type="password" class="form-control shadow-none border border-1 border-dark" placeholder="Confirm Password" required>

                            <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                type="button" id="toggleConfirmPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn fw-bold w-100" style="background-color: #d9a441; color: #212529; border: none;" >
                            Sign Up
                        </button>
                    </div>

                    <p class="text-center mt-3 mb-0">
                        Already a member?
                        <a href="{{ route('signin') }}" class="text-decoration-none" style="color: #b7791f;">Login here.</a>
                    </p>


                </form>

            </div>
        </div>
    </div>
</div>
@endsection