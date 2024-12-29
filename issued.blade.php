@extends('app.app')
@section('main')
    <div class="main-box">
        <div class="container">
            <div class="alert-container"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end mb-3">
                        @can('IssuedBookAdd',App\Models\roles_permission::class)
                        <a href="" class="btn btn-dark  align-items-center d-flex" data-bs-toggle="modal"
                        data-bs-target="#addModal">Book Issue</a>
                        @endcan

                    </div>
                    <div class="card p-4">
                        <h1 class="d-flex text-set fw-bold justify-content-between"><span class="select-text-color">Book Issued</span>
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
                        <div class="table">
                            <table class="table border table-bordered table-striped table-hover">
                                <thead class="select-bgcolor">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Issued Date</th>
                                        <th scope="col">Returned Date</th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booksShow as $key)
                                        <tr id="data-{{ $key->id }}">
                                            <th scope="row" class="id">{{ $loop->index + 1 }}</th>
                                            <td class="book_name">{{ $key['book']->title }}</td>
                                            <td class="student_name">{{ $key->students->name }}</td>
                                            <td class="issued_at">{{ $key->issued_at }}</td>
                                            <td class="issued_at">
                                                @if ($key->returned_at == '0000-00-00')
                                                    <button class="btn btn-warning">On Issued</button>
                                                @else
                                                    <span class="bg-light p-1 text-muted">Returned</span><br>
                                                    {{ $key->returned_at }}
                                                @endif


                                            </td>
                                            <td  class="due_date">{{ $key->due_date }}</td>
                                            <td>
                                                @can('IssuedBookDelete',App\Models\roles_permission::class)
                                                <button value="{{ $key->id }}" class="btn edit1 btn-secondary" data-bs-toggle="modal" data-bs-target="#edit">
                                                    <i class="bi bi-pencil-fill"></i>
                                               </button>
                                                @endcan

                                               @can('IssuedBookDelete',App\Models\roles_permission::class)
                                                    <button value="{{ $key->id }}" class="btn delete btn-danger">
                                                        <i class="bi bi-x-octagon-fill"></i>
                                                    </button>
                                               @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $booksShow->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal " id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Book Issued</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            {{ html()->form()->attribute('id', 'editform-data')->open() }}
                            <div class="form-group">
                                {{ html()->label('Book Name')->class('form-label') }}
                                <select name="book_id" id="editbook_id" class="form-select">
                                    <option value="">Select Book</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book['id'] }}">{{ $book['title'] }}</option>
                                    @endforeach
                                </select>
                                <span id="bookError" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                {{ html()->label('Student Name')->class('form-label') }}
                                <select name="user_id" id="edituser_id" class="form-select">
                                    <option value="">Select Option</option>
                                    @foreach ($student as $students)
                                        <option value="{{ $students['id'] }}">{{ $students->name }}</option>
                                    @endforeach
                                </select>
                                <span id="userError" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                {{ html()->label('Issued Date')->class('form-label') }}
                                {{ html()->date('issued_at')->class('form-control')->id('editissued_at') }}
                                <span id="IssuedError" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                {{ html()->label('Due Date')->class('form-label') }}
                                {{ html()->date('due_date')->class('form-control')->id('editdue_date') }}
                                <span id="dueError" class="text-danger"></span>
                                {{ html()->input('hidden')->id('editid') }}
                            </div>
                            <div class="form-group">
                                {{ html()->submit('Submit')->class('btn btn-dark mt-3') }}
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="addModal"  aria-labelledby="#exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title select-text-color" id="exampleModalLabel">Update Book Issued</h5>
                        <button type="button" class="btn-close end" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            {{ html()->form()->attribute('id', 'form-data')->open() }}
                            <div class="form-group">
                                {{ html()->label('Book Name')->class('form-label') }}
                                <select name="book_id" id="book_id" class="form-select">
                                    <option value="">Select Book</option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book['id'] }}">{{ $book['title'] }}</option>
                                    @endforeach
                                </select>
                                <span id="bookError" class="text-danger"></span>

                            </div>
                            <div class="form-group">
                                {{ html()->label('Student Name')->class('form-label') }}
                                <select name="user_id" id="user_id" class="form-select">
                                    <option value="">Select Option</option>
                                    @foreach ($student as $students)
                                        <option value="{{ $students['id'] }}">{{ $students->name }}</option>
                                    @endforeach
                                </select>
                                <span id="userError" class="text-danger"></span>

                            </div>
                            <div class="form-group">
                                {{ html()->label('Issued Date')->class('form-label') }}
                                {{ html()->date('issued_at')->class('form-control')->id('issued_at') }}
                                <span id="IssuedError" class="text-danger"></span>

                            </div>
                            <div class="form-group">
                                {{ html()->label('Due Date')->class('form-label') }}
                                {{ html()->date('due_date')->class('form-control')->id('due_date') }}
                                <span id="dueError" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                {{ html()->submit('Submit')->class('btn btn-dark mt-3') }}
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn end btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function() {

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
            $('#form-data').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $('#userError').text('');
                $('#bookError').text('');
                $('#IssuedError').text('');
                $('#dueError').text('');
                $('form select').removeClass('is-invalid');
                $('form input').removeClass('is-invalid');
                $.ajax({
                    url: "{{ route('book.issue.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            alertMessage('success', response.success)

                            $('#addModal').modal('hide');
                            $('#form-data')[0].reset();
                            $('table tbody').append(`
                                    <tr>
                                    <th scope="row">${response.data.id}</th>
                                    <td>${response.data.book.title}</td>
                                    <td>${response.data.students.name}</td>
                                    <td>${response.data.issued_at}</td>
                                    <td>${response.data.due_date}</td>
                                    <td>
                                        <button value="${response.data.id}" class="btn edit1 btn-success" data-bs-toggle="modal" data-bs-target="#edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <button value="${response.data.id}" class="btn delete btn-danger">
                                            <i class="bi bi-x-octagon-fill"></i>
                                        </button>
                                    </td>
                                    </tr>
                    `);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            // Show validation errors and add the 'is-invalid' class
                            if (errors.user_id) {
                                $('#userError').text(errors.user_id);
                                $('#user_id').addClass('is-invalid');
                            }
                            if (errors.book_id) {
                                $('#bookError').text(errors.book_id);
                                $('#book_id').addClass('is-invalid');
                            }
                            if (errors.issued_at) {
                                $('#IssuedError').text(errors.issued_at);
                                $('#issued_at').addClass('is-invalid');
                            }
                            if (errors.due_date) {
                                $('#dueError').text(errors.due_date);
                                $('#due_date').addClass('is-invalid');
                            }
                        } else {
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    }
                });
            })

            $('.edit1').on('click', function() {
                var id = $(this).val();
                alert(id);
                $.ajax({
                    url:"{{ url('book/issue/edit') }}/"+id,
                    type:"GET",
                    data:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        // alert(response.success)
                        if(response.success){
                            $("#editbook_id").val(response.data.book_id).trigger('change');
                            $("#edituser_id").val(response.data.user_id).trigger('change');
                            $("#editissued_at").val(response.data.issued_at);
                            $('#editdue_date').val(response.data.due_date);
                            $('#editid').val(response.data.id);
                        }
                    }
                });
            })

            $('#editform-data').on('submit',function(e){
                e.preventDefault();
                // alert('bhuj')
                var formData  = new FormData(this);
                var id = $('#editid').val();
                // alert(id);
                $.ajax({
                    url:"{{ url('book/issue/update') }}/"+ id,
                    type:"POST",
                    data:formData,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        if(response.success){
                            var updateRow = $("#data-"+id);
                            updateRow.find('.book_name').text(response.data.book.title);
                            updateRow.find('.user_name').text(response.data.students.name);
                            updateRow.find('.issued_at').text(response.data.issued_at);
                            updateRow.find('.due_date').text(response.data.due_date);
                            $('#edit').modal('hide');
                            alertMessage('success', response.success)
                        }
                    }
                });
            })

            $(".delete").on('click',function(){
                var id = $(this).val();
                var confirmation = confirm('you want to delete this item')
                // alert(id);
                if(confirmation){
                    $.ajax({
                    url:"{{ url('book/issue/delete') }}/"+id,
                    type:"GET",
                    data:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        if(response.success){
                            $("#data-"+id).remove();
                            alertMessage('success', response.success)

                        }
                    }
                });
                }

            })

            $('.end').on('click', function() {
                $('#form-data')[0].reset();
            });

        })
    </script>
@endsection
