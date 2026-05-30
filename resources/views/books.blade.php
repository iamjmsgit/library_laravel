@extends('layouts.userdash')

@section('title', 'Book')

@section('content')

<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h2>Book Management</h2>
        </div>

        <button type="button" class="btn btn-primary fw-bold text-white" data-bs-toggle="modal" data-bs-target="#AddNewModal">
            <i class="bi bi-journal-plus me-2"></i>Add New Book
        </button>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Book Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                    <th scope="col">Published Year</th>
                    <th scope="col">Date Added</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @forelse ($books as $book)
                <tr class="border-start border-end">
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->created_at->format('M d, Y') }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#editModal{{ $book->id }}">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>

                        <button type="button" class="btn btn-sm btn-danger fw-bold text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $book->id }}">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </td>
                </tr>

                <!-- Delete Btn Modal -->
                <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1"
                    aria-labelledby="DeleteBtnModalLabel{{ $book->id }}" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title fw-bold" id="DeleteBtnModalLabel{{ $book->id }}">Delete Book</h5>
                            </div>

                            <div class="modal-body">
                                <center>
                                    <p>Are you sure you want to delete this book?</p>

                                    <form action="/deleteBook/{{ $book->id }}" method="POST">
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

                <!-- Edit Btn Modal -->
                <div class="modal fade" id="editModal{{ $book->id }}" tabindex="-1"
                    aria-labelledby="EditBtnModalLabel{{ $book->id }}" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title fw-bold" id="EditBtnModalLabel{{ $book->id }}">Edit Book</h5>
                                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <form action="/editBook/{{ $book->id }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <input name="title" type="text"
                                            class="form-control shadow-none border border-1 border-dark"
                                            value="{{ $book->title }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <input name="author" type="text"
                                            class="form-control shadow-none border border-1 border-dark"
                                            value="{{ $book->author }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <select name="category" class="form-select shadow-none border border-1 border-dark" required>
                                            <option value="">Select Category</option>
                                            <option value="Fiction" {{ $book->category == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                                            <option value="Science" {{ $book->category == 'Science' ? 'selected' : '' }}>Science</option>
                                            <option value="History" {{ $book->category == 'History' ? 'selected' : '' }}>History</option>
                                            <option value="Programming" {{ $book->category == 'Programming' ? 'selected' : '' }}>Programming</option>
                                            <option value="Education" {{ $book->category == 'Education' ? 'selected' : '' }}>Education</option>
                                            <option value="Novel" {{ $book->category == 'Novel' ? 'selected' : '' }}>Novel</option>
                                            <option value="Other" {{ $book->category == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <input name="published_year" type="number"
                                            class="form-control shadow-none border border-1 border-dark"
                                            value="{{ $book->published_year }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-warning fw-bold w-100">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="6" class="text-center">No records found</td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ADD NEW BOOK MODAL -->
    <div class="modal fade" id="AddNewModal" tabindex="-1" aria-labelledby="AddNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="AddNewModalLabel">Add New Book</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="/addBook" method="POST">
                        @csrf

                        <div class="mb-3">
                            <input name="title" type="text" class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Book title" required>
                        </div>

                        <div class="mb-3">
                            <input name="author" type="text" class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Author name" required>
                        </div>

                        <div class="mb-3">
                            <select name="category" class="form-select shadow-none border border-1 border-dark" required>
                                <option value="">Select Category</option>
                                <option value="Fiction">Fiction</option>
                                <option value="Science">Science</option>
                                <option value="History">History</option>
                                <option value="Programming">Programming</option>
                                <option value="Education">Education</option>
                                <option value="Novel">Novel</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <input name="published_year" type="number" class="form-control shadow-none border border-1 border-dark"
                                placeholder="Enter Published year" required>
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold w-100">Add</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection