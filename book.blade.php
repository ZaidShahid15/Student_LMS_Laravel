@extends('app.app')
@section('main')
<div class="main-box">
    <div class="container">
        <div class="alert-container"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-3">
                    @can('BookAdd',App\Models\roles_permission::class)
                        <a href="" class="btn btn-dark d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addModal">Add Books</a>
                    @endcan

                </div>
                <div class="card p-4">
                    <h1 class="d-flex text-set fw-bold justify-content-between"><span  class="select-text-color">Books</span>
                        <form>
                        <div class="d-flex ">

                            <input class="form-control border shadow-none me-2" name="search"
                            value="{{ request()->input('search') }}" type="search" placeholder="Search">
                            <button class=" btn btn-primary " type="submit">
                            {{-- <i class="bi bi-search"></i> --}}
                             search
                            </button>
                        </div>

                           </form>
                    </h1>
                    <hr>
                    <div class="table-responsive">
                        <table class="table border table-bordered table-striped table-hover">
                            <thead class="select-bgcolor">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Published Year</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($book as $books)
                                <tr id="data-{{ $books['id'] }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="title">{{ $books['title'] }}</td>
                                    <td class="cat_name">{{ $books['category']->name }}</td>
                                    <td class="Auth_name">{{ $books['author']->name }}</td>
                                    <td>{{ $books['isbn'] }}</td>
                                    <td>{{ $books['published_year'] }}</td>
                                    <td class="gap-4 action">

                                        @can( 'BookEdit',App\Models\roles_permission::class)
                                            <button value="{{ $books['id'] }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal" class="btn edit shadow-none btn-secondary">
                                            <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        @endcan

                                        @can( 'BookDelete',App\Models\roles_permission::class)
                                            <button value="{{ $books['id'] }}" class="btn delete shadow-none btn-danger">
                                                <i class="bi bi-x-octagon-fill"></i>
                                            </button>
                                        @endcan

                                        @if(Auth::user()->role_id != $role->id)
                                        @php
                                            $bookRequest = $request->where('book_id', $books['id'])->first();
                                        @endphp

                                        @if(!$bookRequest || $bookRequest->request == NULL)
                                            <!-- If the request is null or equals 0, show the 'Request' button -->
                                            <button value="{{ $books['id'] }}" class="btn assecc shadow-none btn-danger">
                                                Request
                                            </button>
                                        @else
                                            <!-- If the request exists and is not 0, show the 'Set h' button -->
                                            <div id="check-{{ $books['id'] }}">
                                                <span class=" p-2 shadow-none bg-light text-muted">
                                                    Request Sent
                                                </span>

                                            </div>
                                        @endif
                                    @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>


                      <div class="d-flex justify-content-end">
                        {{ $book->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title select-text-color" id="exampleModalLabel">Add Book</h5>
            <button type="button" class="btn-close end" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form">
                    {{ html()->form()->attribute('id','book-form')->open() }}
                    <div class="form-group mb-3">
                        {{ html()->label('Book Name') }}
                        {{ html()->input('text')->name('title')->attribute('id','title')->attribute('class','form-control shadow-none') }}
                        <span class="text-danger" id="titleError"></span>
                    </div>
                    <div class="form-group mb-3">
                        {{ html()->label('Category') }}
                        <select name="category_id" id="category_id" class="form-select shadow-none">
                            <option value="">Select a category</option>
                            @foreach ($cetagori as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="categoryError"></span>
                    </div>

                    <div class="form-group mb-3">
                        {{ html()->label('Author') }}
                        <select name="author_id" id="author_id" class="form-select shadow-none">
                            <option value="">Select an author</option>
                            @foreach ($author as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="autherError"></span>

                    </div>


                    <div class="form-group mb-3">
                        {{ html()->label('Published date') }}
                        {{ html()->input('date')->name('published_year')->attribute('id','published_year')->attribute('class','form-control') }}
                        <span class="text-danger" id="publishedError"></span>

                    </div>
                    {{ html()->submit('submit')->attribute('class','form-control select-bgcolor') }}
                    {{ html()->form()->close() }}
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn end btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    <!-- EditModal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title select-text-color" id="exampleModalLabel">Edit Book</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form">
                    {{ html()->form()->attribute('id','book-update-form')->open() }}
                    <div class="form-group mb-3">
                        {{ html()->label('Book Name') }}
                        {{ html()->input('text')->name('title')->attribute('id','titleedit')->attribute('class','form-control shadow-none') }}
                        <span class="text-danger" id="titleError"></span>
                    </div>
                    <div class="form-group mb-3">
                        {{ html()->label('Category') }}
                        <select name="category_id" id="category_idedit" class="form-select shadow-none">
                            <option value="">Select a category</option>
                            @foreach ($cetagori as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="categoryError"></span>
                    </div>

                    <div class="form-group mb-3">
                        {{ html()->label('Author') }}
                        <select name="author_id" id="editauthor_id" class="form-select editauthor_id shadow-none">
                            <option value="">Select an author</option>
                            @foreach ($author as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="autherError"></span>
                    </div>

                    <div class="form-group mb-3">
                        {{ html()->label('Published date') }}
                        {{ html()->input('date')->name('published_year')->attribute('id','published_yearedit')->attribute('class','form-control') }}
                        <span class="text-danger" id="publishedError"></span>

                    </div>
                    {{ html()->input('hidden')->attribute('id','book_id') }}
                    {{ html()->submit('submit')->attribute('class','form-control select-bgcolor') }}
                    {{ html()->form()->close() }}
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        function alertMessage(type, message) {
            // Clear any existing alerts
            $('.alert-container').html(`
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);

            // Auto-dismiss after 3 seconds (optional)
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        }
    $(document).ready(function(){
        $('#book-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('form input').removeClass('is-invalid');
            $('form select').removeClass('is-invalid');

            $('#titleError').text('');
            $('#categoryError').text('');
            $('#autherError').text('');
            $('#publishedError').text('');
            $.ajax({
                url: "{{ route('addbooks') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Close the modal
                        $('#addModal').modal('hide');
                        alertMessage('success',response.success)
                        // Append the new book to the table
                        $('table tbody').append(`
                            <tr>
                                <th scope="row">${response.data.id}</th>
                                <td>${response.data.title}</td>
                                <td>${response.data.category.name}</td> <!-- Corrected typo from 'catgory' to 'category' -->
                                <td>${response.data.author.name}</td>
                                <td>${response.data.isbn}</td>
                                <td>${response.data.published_year}</td>
                                <td class="gap-4">
                                    <button value="${response.data.id}" data-bs-toggle="modal"
                                        data-bs-target="#editModal" class="btn edit shadow-none btn-success"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <button value="${response.data.id}" class="btn delete shadow-none btn-danger"><i
                                            class="bi bi-x-octagon-fill"></i></button>
                                </td>
                            </tr>
                        `);

                        // Clear the form
                        $('#book-form')[0].reset();
                    } else {
                        alert(response.error);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        if (errors.title) {
                            $('#titleError').text(errors.title);
                            $('#title').addClass('is-invalid');
                        }

                        if(errors.category_id){
                            $('#categoryError').text(errors.category_id);
                            $('#category_id').addClass('is-invalid')
                        }

                        if(errors.author_id){
                            $('#autherError').text(errors.author_id);
                            $('#author_id').addClass('is-invalid');
                        }

                        if(errors.published_year){
                           $('#publishedError').text(errors.published_year);
                           $('#published_year').addClass('is-invalid');
                        }

                    } else {
                        alert('An error occurred. Please try again.');
                    }
                }
            });
        });


        $('.edit').on('click', function() {
            var id = $(this).val(); // Get the ID from the button clicked
            $('#book-update-form')[0].reset();
            $.ajax({
                url: "{{ url('editid') }}/" + id,
                type: "GET",
                success: function(response) {
                    // Fill other fields (like title)
                    $('#titleedit').val(response.data.title);

                    $('#category_idedit').val(response.data.category_id).trigger('change');

                    $('#editauthor_id').val(response.data.author_id).trigger('change');

                    $('#published_yearedit').val(response.data.published_year)

                    $('#category_idedit').val(response.data.category.id);

                    $('#book_id').val(response.data.id);
                }
            });
        });


        $('#book-update-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id = $('#book_id').val();

            $.ajax({
                url: "{{ url('updatebook') }}/" + id,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alertMessage(response.success);
                    if(response.success) {
                        $('#editModal').modal('hide');

                        // Select the row by ID
                        var updateRow = $('#data-' + id);

                        // Update the specific columns with new values
                        updateRow.find('.title').text(response.data.title);
                        updateRow.find('.cat_name').text(response.data.category.name);
                        updateRow.find('.Auth_name').text(response.data.author.name);
                        updateRow.find('.isbn').text(response.data.isbn);  // If you want to update ISBN
                        updateRow.find('.published_year').text(response.data.published_year); // Published Year
                    }
                }
            });
        });


        $('.delete').on('click',function(){
            var id = $(this).val();
            var confirmation = confirm('you want to delete this item');
            if(confirmation){
                $.ajax({
                url:"{{ url('deletebook') }}/"+id,
                type:"GET",
                data:false,
                processData:false,
                success:function(response){
                    $('#data-'+ id).remove();
                }
            });
            }


        })

        $('.end').on('click', function() {
            $('#book-form')[0].reset();
        });


        $('.assecc').on('click', function() {
            var book_id = $(this).val();
            var token = $('meta[name="csrf-token"]').attr('content');

            // Construct the URL with query parameters since you're using GET
            $.ajax({
                url: "{{ url('access') }}", // Your Laravel route for handling the request
                type: 'GET', // Using GET request
                headers: {
                    'X-CSRF-TOKEN': token // CSRF token for security
                },
                data: {book_id: book_id}, // Send book_id as query parameter
                success: function(response) {
                    if (response.success) {
                        $("#data-" + book_id).find('.action').html(`
                    <span class="assecc p-2 shadow-none bg-light text-muted">
                        Request Sent
                    </span>
                `);
                    }
                }
            });
        });


    });


    </script>
@endsection

