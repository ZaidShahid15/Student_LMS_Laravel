@extends('app.app')

@section('main')
    <!-- Main Content -->
    <div class="main-box">
        <div class="container">
            <div class="alert-container"></div>

            <div class="row">
                <div class="col-md-12">
                    @can('StudentAdd',App\Models\roles_permission::class)
                        <div class="d-flex justify-content-end mb-3">
                            <a href="#" class="btn btn-dark shadow-none align-items-center d-flex" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Students</a>
                        </div>
                    @endcan

                    <div class="card p-4 bg-transparent shadow">
                        <h1 class="d-flex fw-bold text-set justify-content-between">
                            <span class="select-text-color">Students</span>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecored as $user)
                                        <tr id="rowdata-{{ $user->id }}">
                                            <th scope="row" class="id">{{ $loop->iteration }}</th>
                                            <td class="name">{{ $user->name }}</td>
                                            <td class="email">{{ $user->email }}</td>
                                            <td class="role_name">{{ $user->role_name }}</td>
                                            <td>
                                                @can('StudentEdit',App\Models\roles_permission::class)
                                                <button value="{{ $user->id }}" class="btn edit btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                @endcan

                                                @can('StudentDelete',App\Models\roles_permission::class)
                                                <button value="{{ $user->id }}" class="btn btn-danger delete">
                                                    <i class="bi bi-x-octagon-fill"></i>
                                                </button>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title shadow-none select-text-color" id="exampleModalLabel">Add Students</h5>
                    <button type="button" class="btn-close end" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id','User-form')->open() }}
                    <div class="form-group">
                        {{ html()->label('Name')->for('name') }}
                        {{ html()->text('name')->class('form-control shadow-none')->id('name') }}
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group">
                        {{ html()->label('Email')->for('email') }}
                        {{ html()->email('email')->class('form-control shadow-none')->id('email') }}
                        <span class="text-danger" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        {{ html()->label('Password')->for('password') }}
                        {{ html()->password('password')->class('form-control shadow-none')->id('password') }}
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                    <div class="form-group">
                        {{ html()->label('Role') }}
                        <select name="role_id" id="role" class="form-select shadow-none">
                            <option value="">Select</option>

                            @foreach ($rolesdata as $key)
                                <option value="{{ $key->id }}">{{ $key->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="roleError"></span>
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

    <!-- Edit User Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title shadow-none select-text-color" id="editModalLabel">Update Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id','edit-User-form')->open() }}
                    <div class="form-group">
                        {{ html()->label('Name')->for('editname') }}
                        {{ html()->text('name')->class('form-control shadow-none')->id('editname') }}
                        <span class="text-danger" id="editNameError"></span>
                    </div>
                    <div class="form-group">
                        {{ html()->label('Email')->for('editemail') }}
                        {{ html()->email('email')->class('form-control shadow-none')->id('editemail') }}
                        <span class="text-danger" id="editEmailError"></span>
                    </div>
                    <div class="form-group">
                        {{ html()->label('Password (Optional)')->for('editpassword') }}
                        {{ html()->input('password')->class('form-control shadow-none')->id('editpassword') }}
                    </div>
                    <div class="form-group">
                        {{ html()->label('Role') }}
                        <select name="role" id="editrole" class="form-select shadow-none">
                            <option value="">Select</option>
                            @foreach ($rolesdata as $key)
                                <option value="{{ $key->id }}">{{ $key->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="editRoleError"></span>
                    </div>
                    {{ html()->input('hidden')->id('editid') }}
                    {{ html()->submit('Submit')->attribute('class','btn btn-primary') }}
                    {{ html()->form()->close() }}
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
    $(document).ready(function() {
        // Add User Logic
        $('#User-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // Clear previous error messages
            $('form input').removeClass('is-invalid');
            $('#nameError, #emailError, #passwordError, #roleError').text('');

            $.ajax({
                url: "{{ route('store_Student') }}",  // Route to store student
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Add new row to table after successful form submission
                        $('table tbody').append(`
                            <tr>
                                <th scope="row">${response.data.id}</th>
                                <td>${response.data.name}</td>
                                <td>${response.data.email}</td>
                               <td>${response.role[0].name}</td>
                                <td>
                                    <button value="${response.data.id}" class="btn edit btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button value="${response.data.id}" class="btn btn-danger delete">
                                        <i class="bi bi-x-octagon-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                        alertMessage('success', 'User added successfully!');
                        $('#User-form')[0].reset();
                        $('#exampleModal').modal('hide');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        // Show validation errors and add the 'is-invalid' class
                        if (errors.name) {
                            $('#nameError').text(errors.name[0]);
                            $('#name').addClass('is-invalid');
                        }
                        if (errors.email) {
                            $('#emailError').text(errors.email[0]);
                            $('#email').addClass('is-invalid');
                        }
                        if (errors.password) {
                            $('#passwordError').text(errors.password[0]);
                            $('#password').addClass('is-invalid');
                        }
                        if (errors.role) {
                            $('#roleError').text(errors.role[0]);
                            $('#role').addClass('is-invalid');
                        }
                    } else {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                }
            });
        });
        // Edit User Logic
        $('.edit').on('click', function() {
            var id = $(this).val();
            $('#editname').val('');
            $('#editemail').val('');
            $.ajax({
                url: "{{ url('edit_Student') }}/" + id,  // Adjust this to the correct route
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Set the form fields
                        $('#editname').val(response.data.name);
                        $('#editemail').val(response.data.email);
                        $('#editrole').val(response.data.role_id).trigger('change'); // Set the selected role
                        $('#editid').val(id);
                    }
                }
            });
        });
        // Update User Logic
        $('#edit-User-form').on('submit', function(e) {
            e.preventDefault();
            var id = $('#editid').val();
            alert(id);
            var formData = new FormData(this);

            // Clear previous error messages
            $('form input').removeClass('is-invalid');
            $('#editNameError, #editEmailError, #editRoleError').text('');

            $.ajax({
                url: "{{ url('/update/Student') }}/" + id,  // Adjust this to the correct route
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                            if (response.success) {
                                alertMessage('success',response.message)
                                $('#editModal').modal('hide');
                                $('#edit-User-form')[0].reset();
                            var updateRow  = $('#rowdata-'+id);
                            updateRow.find('.name').text(response.data.name);
                            updateRow.find('.email').text(response.data.email);
                            updateRow.find('.role').text(response.role[0].name);  // Update role name here

                        }
                }
            });
        });

        $(".delete").on('click',function(){
            var id  = $(this).val();
            var confrimation = confirm('are you sure , You want to delete this')
            if(confrimation){
                $.ajax({
                url:"{{ url('/delete/Student') }}/"+id,
                type:"GET",
                data:false,
                processData:false,
                contentType:false,
                success:function(response){
                    if(response.success){
                        $('#rowdata-'+id).remove();
                    }
                }
            });
            }

        })

        $('.end').on('click', function() {
            $('#User-form')[0].reset();
        });
});
</script>
@endsection
