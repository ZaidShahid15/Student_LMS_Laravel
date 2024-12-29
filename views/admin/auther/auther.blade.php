@extends('app.app')
@section('main')
<div class="main-box">
    <div class="container">
        <div class="alert-container"></div>

        <div class="row">
            <div class="col-md-12">
              <div class="btn d-flex justify-content-end">
                @can('AuthAdd',App\Models\roles_permission::class)
                <a href="" class="btn btn-dark  align-items-center shadow-none"
                data-bs-toggle="modal" data-bs-target="#AddModal">Add Author</a>
                @endcan

              </div>
                <div class="card p-4">
                    <h1 class="justify-content-between text-set fw-bold  d-flex "><span class="select-text-color">Add
                            Author</span>

                           <form>
                        <div class="d-flex ">

                            <input class="form-control border shadow-none me-2" name="search"
                            value="{{ request()->input('search') }}" type="search" placeholder="Search">
                            <button class=" btn btn-primary " type="submit">
                            {{-- <i class="bi bi-search"></i> --}}
                             search
                            </button>
                           </form>
                        </div>

                        </h1>

                    <hr>
                    <table class="table border table-bordered table-striped table-hover">
                        <thead class="select-bgcolor">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($authors as $auther)
                            <tr  id="target-{{ $auther['id'] }}">
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td class="name">{{ $auther['name'] }}</td>
                                <td>
                                    @can('AuthEdit',App\Models\roles_permission::class)

                                    <button value="{{ $auther['id'] }}" data-bs-toggle="modal" data-bs-target="#editModal" class="btn edit shadow-none btn-secondary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    @endcan

                                    @can('AuthDelete',App\Models\roles_permission::class)
                                    <button value="{{ $auther['id'] }}" class="btn delete shadow-none btn-danger">
                                        <i class="bi bi-x-octagon-fill"></i>
                                    </button>
                                    @endcan

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center bg-light">data not found</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


    <!-- Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title select-text-color" id="exampleModalLabel">Add Author</h5>
                    <button type="button" class="btn-close end" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id', 'auth-form')->open() }}
                        {{ csrf_field() }}

                    <div class="form-group mb-3">
                        {{ html()->label('Author Name')->attribute('class', 'select-text-color') }}
                        {{ html()->input('text')->name('name')->attribute('class', 'form-control shadow-none')->attribute('id', 'name') }}
                        <!-- Fixed 'text-danger' typo -->
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    {{ html()->submit('Submit')->attribute('class', 'btn select-bgcolor') }}
                    {{ html()->form()->close() }}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn end btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


     <!--Edit Modal -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title select-text-color" id="exampleModalLabel">Update Auther</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id', 'author-update')->open() }}
                    {{ csrf_field() }}
                    <div class="form-group mb-3">
                        {{ html()->label('Name')->attribute('class', 'select-text-color') }}
                        {{ html()->input('text')->name('name')->attribute('class', 'form-control shadow-none')->attribute('id', 'editname') }}
                        <!-- Fixed 'text-danger' typo -->
                        <span class="text-danger" id="nameEditError"></span>
                    </div>
                    {{ html()->input('hidden')->attribute('id', 'editid') }}
                    {{ html()->submit('Submit')->attribute('class', 'btn select-bgcolor') }}
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

    $(document).ready(function(){
        $('#auth-form').on('submit', function(e) {
          e.preventDefault();
            var formData = new FormData(this);
            $('form input').removeClass('is-invalid');
            $('#editname').val('');

            $.ajax({
                url: "{{ route('addAuth') }}", // Ensure this route exists and points to the correct controller method
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json', // Handle the response as JSON
                success: function(response) {
                    if (response.success) {
                        alertMessage('success', 'Category added successfully!');

                        // Hide the modal
                        $('#AddModal').modal('hide');

                        // Append new category row in the table
                        $('table tbody').append(`
                            <tr id="data-${response.data.id}">
                                <th scope="row">${response.data.id}</th>
                                <td class="name">${response.data.name}</td>
                                <td class="gap-4">
                                    <button value="${response.data.id}" class="btn edit shadow-none btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button value="${response.data.id}" class="btn delete shadow-none btn-danger">
                                        <i class="bi bi-x-octagon-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                            $('#auth-form')[0].reset();
                        // Re-bind click events for the newly added buttons (if necessary)
                        rebindButtonEvents(); // Function to handle new button events, if required
                    }
                },
                error: function(xhr) {
                    // Display validation errors
                    var errors = xhr.responseJSON.errors;
                    if (errors.name) {
                        $('#nameError').text(errors.name[0]); // Display error for 'name' field
                        $('#name').addClass('is-invalid');
                    }
                }
            });
        });



        $('.edit').on('click',function(){
            var id = $(this).val();
            $('#editname').val('');

            $.ajax({
                url:"{{ url('editauth') }}/" + id,
                type:"GET",
                data:false,
                processData:false,
                contentType:false,
                success:function(response){
                    $('#editname').val(response.data.name)
                    $('#editid').val(response.data.id)
                }
            });
        })

        $('#author-update').on('submit',function(e){
            e.preventDefault();
            // alert('hello')
            var id  = $('#editid').val();
            // alert(id)

            var fromData = new FormData(this);
            $.ajax({
                url:"{{ url('updateauth') }}/" + id,
                type:"POST",
                data:fromData,
                processData:false,
                contentType:false,
                success:function(response){
                    alertMessage('success',response.success);
                    $('#editModal').modal('hide');
                    var update = $('#target-'+ id);

                    update.find('.name').text(response.data.name);
                }
            });
        });

        $('.delete').on('click',function(){
            var id = $(this).val();
            // alert(id);
            var confirmation = confirm('you want to delete this item');
            if(confirmation){
                $.ajax({
                url:"{{ url('authdelee') }}/"+ id,
                type:"GET",
                data:false,
                processData:false,
                contentType:false,
                success:function(response){
                    alertMessage('success',response.success)
                    $('#target-'+ id).remove()
                }
            });
            }

        })

        $('.end').on('click', function() {
            $('#auth-form')[0].reset();
        });
    });
    </script>

@endsection
