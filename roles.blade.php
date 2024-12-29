@extends('app.app')
@section('main')
    <div class="main-box">
        <div class="container">
            <div class="alert-container"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end mb-3">
                        @can('RolesAdd',App\Models\roles_permission::class)
                            <a href="" class="btn btn-dark  align-items-center d-flex" data-bs-toggle="modal" data-bs-target="#exampleModal" >Add Roles</a>
                        @endcan
                    </div>
                    <div class="card p-4">
                        <h1 class="d-flex fw-bold text-set justify-content-between"><span class="select-text-color">Roles & Permission</span>
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
                        <table class="table border table-bordered table-striped table-hover">
                            <thead class="select-bgcolor ">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $key)
                                <tr id="delete_row{{ $key['id'] }}">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td class="name">{{ $key['name'] }}</td>
                                        <td class="gap-4">
                                            @can( 'RolesEdit',App\Models\roles_permission::class)
                                            <button value="{{ $key['id'] }}" data-bs-toggle="modal" data-bs-target="#editedit" class="btn edit shadow-none btn-secondary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            @endcan


                                            @can( 'RolesDelete',App\Models\roles_permission::class)
                                            <button value="{{ $key['id'] }}" class="btn delete shadow-none btn-danger">
                                                <i class="bi bi-x-octagon-fill"></i>
                                            </button>
                                            @endcan


                                        </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $role->links()  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title select-text-color" id="exampleModalLabel">Add Roles & permission</h5>
                <button type="button" class="btn-close end" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                {{ html()->form()->attribute('id','permission-form')->open() }}
                    <div class="form-group mb-3">
                        {{ html()->label('Role Name') }}
                        {{ html()->input('text')->name('name')->attribute('class','form-control shadow-none')->attribute('id','name') }}
                        <span class="text-danger" id="namError"></span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($getpermission as $data)
                            <div class="row">
                                <div class="col-md-3">
                                    <span>{{ $data['name'] }}</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                    @foreach ($data['group'] as $key )
                                            <div class="col-md-3 ">
                                                <label class="gap-1 d-flex">
                                                    <input type="checkbox" name="permission_id[]" id="permission_id" value="{{ $key['id'] }}">{{ $key['name'] }}
                                                </label>
                                            </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                    {{ html()->submit('Submit')->attribute('class','btn btn-primary') }}
                {{ html()->form()->close() }}
                </div>
                <div class="modal-footer">
                <button type="button" class="btn end btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="editedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title select-text-color" id="exampleModalLabel">Update Roles & permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id', 'edit-permission-form')->open() }}
                        <div class="form-group mb-3">
                            {{ html()->label('Role Name') }}
                            {{ html()->input('text')->name('name')->attribute('class', 'form-control shadow-none')->attribute('id', 'nameedit') }}
                            <span class="text-danger" id="namError"></span>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($getpermission as $data)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span>{{ $data['name'] }}</span>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                @foreach ($data['group'] as $key)
                                                    <div class="col-md-3">
                                                        <label class="gap-1 d-flex">
                                                            <input type="checkbox" name="permission_id[]" id="permission_id" value="{{ $key['id'] }}"> {{ $key['name'] }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                            {{ html()->input('hidden')->attribute('id', 'IDedit') }}
                        </div>
                        {{ html()->submit('Submit')->attribute('class', 'btn btn-primary') }}
                    {{ html()->form()->close() }}
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
         function alertMessage(type, message) {
        $('.alert-container').html(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);

        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    }
        $(document).ready(function(){
            $('#permission-form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                // Clear previous errors
                $('form input').removeClass('is-invalid');
                $('#namError').text('');

                // Disable submit button to prevent multiple submissions
                $('button[type="submit"]').attr('disabled', true).text('Submitting...');

                $.ajax({
                    url: "{{ route('addpermission') }}",  // Replace with your route
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Show success message
                        alertMessage('success',response.success);

                        // Optionally, close the modal after success
                        $('#exampleModal').modal('hide');

                        // Enable submit button and reset text
                        $('button[type="submit"]').attr('disabled', false).text('Submit');

                        // Optionally, reset the form after success
                        $('#permission-form')[0].reset();
                        $('table tbody').append(`
                                <tr>
                                    <th scope="row">${response.data.id}</th>
                                    <td class="name">${response.data.name}</td>
                                    <td class="gap-4">
                                                <button value="${response.data.id}" data-bs-toggle="modal" data-bs-target="#edit" class="btn edit shadow-none btn-success">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <button value="${response.data.id}" class="btn delete shadow-none btn-danger">
                                                <i class="bi bi-x-octagon-fill"></i>
                                            </button>
                                        </td>
                                </tr>
                        `);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Get validation errors from the response
                            var errors = xhr.responseJSON.errors;

                            // Display the validation error for the 'name' field
                            if (errors.name) {
                                $('#namError').text(errors.name[0]); // Show error below the input field
                                $('#name').addClass('is-invalid');
                            }
                        } else {
                            alert('An error occurred. Please try again.');
                        }

                        // Enable submit button in case of error
                        $('button[type="submit"]').attr('disabled', false).text('Submit');
                    }
                });
            });

            $('.edit').on('click', function() {
                var id = $(this).val();

                $.ajax({
                    url: "{{ url('editpermission') }}/" + id,
                    type: 'GET',
                    data: false,
                    success: function(response) {
                        $('#nameedit').val(response.role['getSingle'].name);
                        $('#IDedit').val(response.role['getSingle'].id);

                        $('input[type="checkbox"][name="permission_id[]"]').prop('checked', false);

                        $.each(response.role['getRolePermisssion'], function(index, value) {
                            $('input[type="checkbox"][value="' + value.permission_id + '"]').prop('checked', true);
                        });

                        $('#yourModalID').modal('show');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                        }
                    }
                });
            });

            $('#edit-permission-form').on('submit', function(e) {
                e.preventDefault();

                var formdata = new FormData(this);
                var id = $('#IDedit').val();

                $.ajax({
                    url: "{{ url('updatepermission') }}/" + id,
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Show success message (corrected)
                            alertMessage('success', response.success);

                            // Hide the modal
                            $('#editedit').modal('hide');

                            // Update the name in the table row
                            $('#delete_row' + id).find('.name').text(response.data.name);
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });


            $('.delete').on('click', function() {
                var id = $(this).val();
                var confrimation = confirm('you want to delete this item');
                if(confrimation){
                    $.ajax({
                    url: "{{ url('roles/delete') }}/" + id,
                    type: 'GET',
                    data: false,
                    success: function(response) {
                        alertMessage('success',response.success);
                        $('#delete_row'+id).remove();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                        }
                    }
                });
                }

            });

            $('.end').on('click', function() {
                $('#permission-form')[0].reset();
            });

        });


    </script>
@endsection
