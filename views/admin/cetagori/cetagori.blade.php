@extends('app.app')
@section('main')
    <!-- Main Content -->
    <div class="main-box">
        <div class="container">
            <div class="alert-container"></div>
            <div class="row ">
                <div class="col-md-12 mt-4">
                    <div class="d-flex justify-content-end mb-3">
                        @can('add',App\Models\roles_permission::class)
                        <a href="" class="btn btn-dark d-flex align-items-center shadow-none"
                        data-bs-toggle="modal" data-bs-target="#AddModal">Add Cetagory</a>
                        @endcan
                    </div>
                    <div class="card p-4">
                        <h1 class="justify-content-between text-set heading fw-bold  d-flex "><span class="select-text-color">Add
                            Category</span>
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
                            <thead class="select-bgcolor" >
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cetagori as $cetagoris)
                                    <tr id="data-{{ $cetagoris['id'] }}">
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td class="name">{{ $cetagoris['name'] }}</td>
                                        <td class="gap-4">

                                            @can('edit',App\Models\roles_permission::class)
                                            <button value="{{ $cetagoris['id'] }}" data-bs-toggle="modal"
                                            data-bs-target="#editModal" class="btn edit shadow-none btn-secondary"><i
                                                class="bi bi-pencil-fill"></i></button>
                                            @endcan

                                            @can('delete',App\Models\roles_permission::class)

                                                    <button value="{{ $cetagoris['id'] }}" class="btn delete shadow-none btn-danger"><i
                                                        class="bi bi-x-octagon-fill"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center bg-light">data not found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="justify-content-end d-flex">
                            {{ $cetagori->links() }}
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
                    <h5 class="modal-title select-text-color" id="exampleModalLabel">Add Cetagorie</h5>
                    <button type="button" class="btn-close end" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id', 'cetagori-form')->open() }}
                    <div class="form-group mb-3">
                        {{ html()->label('Name')->attribute('class', 'select-text-color') }}
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
                    <h5 class="modal-title select-text-color" id="exampleModalLabel">Update Cetagorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ html()->form()->attribute('id', 'cetagori-update-form')->open() }}
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

        $(document).ready(function() {
            // Bind the submit event, not the click event on the form
            $('body').append('<div class="alert-container"></div>');

            $('#cetagori-form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $('#name').val('')
                $('#nameError').text(''); // Show error below the input field
                $('form input').removeClass('is-invalid')
                $.ajax({
                    url: "{{ route('savecetagori') }}", // Update this with the correct route
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#nameError').text(''); // Clear any previous error messages
                        if (response.success) {
                            alertMessage('success',response.message)
                            $('#AddModal').modal('hide'); // Hide the modal after success (optional)
                            $('table tbody').append(`
                            <tr>
                                <th scope="row">${response.data.id}</th>
                                <td>${response.data.name}</td>
                                <td class="gap-4">
                                    <a href="" class="btn btn-success"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="" class="btn btn-danger"><i class="bi bi-x-octagon-fill"></i></a>
                                </td>
                            </tr>
                            `);

                                $('#cetagori-form')[0].reset();
                        } // Display success message (optional)
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Get validation errors from the response
                            var errors = xhr.responseJSON.errors;

                            // Display the validation error for the 'name' field
                            if (errors.name) {
                                $('#nameError').text(errors.name[
                                0]); // Show error below the input field
                                $('#name').addClass('is-invalid')
                            }
                        } else {
                            alertMessage('danger','An error occurred. Please try again.');
                        }
                    }
                });
            });

            $('.edit').on('click', function() {
                var id = $(this).val();
                $('#name').val('');

                $.ajax({
                    url: "{{ url('edit') }}/" + id,
                    success: function(response) {
                        $('#editname').val(response.data.name);
                        $('#editid').val(response.data.id);
                    }
                });
            })

            $('#cetagori-update-form').on('submit', function(e) {
                e.preventDefault();
                // alert('hello');
                var formData = new FormData(this);
                var id = $('#editid').val();

                $.ajax({
                    url: "{{ url('update') }}/" + id,
                    type: 'POST',
                    data:formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log(response.message);
                        if (response.success) {
                            $('#editModal').modal('hide');
                            var updaterow = $('#data-' + id);
                            updaterow.find('.name').text(response.data.name);
                            alertMessage('success',response.message);

                        }

                    }
                });
            });

            $('.delete').on('click',function(){
                var id = $(this).val();
                var confirmation = confirm('Are you sure you want to delete this item?');
                if(confirmation){
                    $.ajax({
                    url:"{{ url('delete') }}/" + id,
                    type:'get',
                    data:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        alertMessage('success',response.success);
                        $('#data-' + id).remove();
                    }
                });
                }

            });

            $('.end').on('click', function() {
                $('#cetagori-form')[0].reset();
            });
        });
    </script>
@endsection
