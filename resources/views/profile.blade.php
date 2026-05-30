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

                    <button type="submit" class="btn btn-warning w-100 fw-bold" name="upload_pic">
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

                        <div class="col-md-6">
                            <label for="phone_number" class="fw-bold">Phone Number</label>
                            <input id="phone_number" name="phone_number" type="tel"
                                class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter phone number"
                                value="{{ session('user')->phone_number }}">
                        </div>

                        <div class="col-md-6">
                            <label for="gender" class="fw-bold">Gender</label>
                            <select id="gender" name="gender"
                                class="form-select shadow-none border border-1 border-dark">
                                <option value="">Select gender</option>
                                <option value="Male" {{ session('user')->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ session('user')->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ session('user')->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="fw-bold">Address</label>
                            <input id="address" name="address" type="text"
                                class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter address"
                                value="{{ session('user')->address }}">
                        </div>
                    </div>

                    <!-- CHANGE PASSWORD SECTION -->
                    <div class="mt-4">
                        <h4>Change Password</h4>
                        <hr>

                        <div class="mb-1">
                            <label for="password" class="fw-bold">Current Password</label>
                            <div class="input-group">
                                <input type="password" id="current_pass" name="current_pass"
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
                        <button type="submit" class="btn btn-warning fw-bold">Save Changes</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection