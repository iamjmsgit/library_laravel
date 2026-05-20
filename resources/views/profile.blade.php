@extends('layouts.profile_nav')

@section('content')

<div class="row">
    <!-- PROFILE PICTURE CARD -->
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <p class="card-text mb-2 text-center fw-bold">Profile picture</p>

                <form action="/updateProfile" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('user')->profile_pic)
                    <img src="{{ asset('uploads/images/' . session('user')->profile_pic) }}" alt="Profile"
                        class="rounded-circle d-block mx-auto mb-3"
                        style="width:140px; height:140px; object-fit:cover;">
                    @else
                    <img src="{{ asset('uploads/images/default.jpg') }}" alt="Profile"
                        class="rounded-circle d-block mx-auto mb-3"
                        style="width:140px; height:140px; object-fit:cover;">
                    @endif

                    <input class="form-control mb-2 shadow-none border border-1 border-dark"
                        type="file" id="formFile" name="profile_pic" required>

                    <button type="submit" class="btn btn-warning w-100" name="upload_pic">
                        Upload Photo
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- USER PROFILE CARD -->
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Profile</h4>
                <hr>

                <form action="/updateProfile" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="fullname" class="fw-bold">Full Name</label>
                            <input id="fullname" name="fullname" type="text"
                                class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Full name"
                                value="{{ session('user')->name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="fw-bold">Email</label>
                            <input id="email" name="email" type="email"
                                class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Email address"
                                value="{{ session('user')->email }}">
                        </div>
                    </div>

                    <!-- CHANGE PASSWORD SECTION -->
                    <div class="mt-4">
                        <h4>Change Password</h4>
                        <hr>

                        <div class="mb-3">
                            <label for="password" class="fw-bold">Current Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password"
                                    class="form-control shadow-none border border-1 border-dark"
                                    placeholder="Enter current password">

                                <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                    type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="new_pass" class="fw-bold">New Password</label>
                                <div class="input-group">
                                    <input type="password" id="new_pass" name="new_pass"
                                        class="form-control shadow-none border border-1 border-dark"
                                        placeholder="Enter new password">

                                    <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                        type="button" id="toggleNewPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="confirm_pass" class="fw-bold">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="confirm_pass" name="confirm_pass"
                                        class="form-control shadow-none border border-1 border-dark"
                                        placeholder="Confirm new password">

                                    <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                        type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning">Save Changes</button>
                        <a href="/dashboard" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection