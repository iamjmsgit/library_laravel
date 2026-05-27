@extends('layouts.userdash')

@section('title', 'User')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h2>User Management</h2>
        </div>

        <button type="button" class="btn btn-primary fw-bold text-white" data-bs-toggle="modal" data-bs-target="#AddNewModal">
            <i class="bi bi-person-plus-fill me-2"></i>Add New Users
        </button>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scoper="col">Date Added</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

                @forelse($user as $users)
                <tr class="border-start border-end">
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->created_at }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#EditModal{{ $users->id }}">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>

                        <button type="button" class="btn btn-sm btn-danger fw-bold text-white" data-bs-toggle="modal" data-bs-target="#DeleteModal{{ $users->id }}">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </td>
                </tr>


                <!-- Edit Btn Modal -->
                <div class="modal fade" id="EditModal{{ $users->id }}" tabindex="-1" aria-labelledby="EditBtnModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title fw-bold" id="EditBtnModalLabel">Edit User</h5>
                                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <form action="/users/edit/{{ $users->id }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <input name="fullname" type="text"
                                            class="form-control shadow-none border border-1 border-dark" value="{{ $users->name }}"
                                            placeholder="Enter New Full name" required>
                                    </div>

                                    <div class="mb-3">
                                        <input name="email" type="email"
                                            class="form-control shadow-none border border-1 border-dark" value="{{ $users->email }}"
                                            placeholder="Enter New Email address"
                                            required>
                                    </div>

                                    <button type="submit" class="btn btn-warning fw-bold w-100">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Btn Modal -->
                <div class="modal fade" id="DeleteModal{{ $users->id }}" tabindex="-1"
                    aria-labelledby="DeleteBtnModalLabel{{ $users->id }}" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title fw-bold" id="DeleteBtnModalLabel">Delete User</h5>
                            </div>

                            <div class="modal-body">
                                <center>
                                    <p>Are you sure you want to delete this user?</p>



                                    <form action="/users/delete/{{ $users->id }}" method="POST">
                                        @csrf

                                        <button type="button" class="btn btn-secondary fw-bold"
                                            data-bs-dismiss="modal">Cancel</button>

                                        <button type="submit" class="btn btn-danger fw-bold">
                                            Confirm Delete
                                        </button>

                                    </form>
                                </center>
                            </div>

                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="5" class="text-center">No records found</td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ADD NEW USER MODAL -->
    <div class="modal fade" id="AddNewModal" tabindex="-1" aria-labelledby="AddNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="AddNewModalLabel">Add New User</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="/users/add" method="POST">
                        @csrf

                        <div class="mb-3">
                            <input name="fullname" type="text" class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Full name" required>
                        </div>

                        <div class="mb-3">
                            <input name="email" type="email" class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Email address" required>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <input id="password" name="password" type="password" class="form-control shadow-none border border-1 border-dark" placeholder="Enter Password" required>

                                <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                    type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <input id="confirmpassword" name="confirmpassword" type="password" class="form-control shadow-none border border-1 border-dark" placeholder="Confirm Password" required>

                                <button class="btn btn-outline-dark border border-1 border-dark shadow-none"
                                    type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold w-100">Add</button>

                    </form>
                </div>
            </div>
        </div>
    </div>



</div>

@endsection