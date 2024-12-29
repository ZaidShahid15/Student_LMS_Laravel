@extends('app.app')
@section('main')
    <div class="main-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-4">
                        <h1 class="select-text-color d-flex justify-content-between">
                            <span>Profile</span>
                            <button type="button" class="btn select-bgcolor" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Set Profile
                            </button>
                        </h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                <div class="img border" style="width: 200px; height: 200px;">
                                    @if (empty($profile->pic))
                                    <img src="{{ asset('pic/userdemo.png') }}" style="width: 100%; height: 100%; object-fit: cover" class="img-fluid" alt="">
                                @else
                                    <img src="/images/{{ $profile->pic }}" style="width: 100%; height: 100%; object-fit: cover" class="img-fluid" alt="">
                                @endif


                                </div>
                            </div>
                            <div class="col-md-8 d-flex align-items-center justify-content-center">
                                <div class="border p-3" style="width: 100%">
                                    <h5 class="gap-3 d-flex"><span class="fw-bold">Name : </span> <span class="text-muted"> {{ Auth::user()->name }}</span></h5>
                                    <hr>
                                    <h5 class="gap-3 d-flex"><span class="fw-bold">Email :</span> <span class="text-muted">{{  Auth::user()->email}}</span></h5>
                                    <hr>
                                    <h5>
                                        <span class="fw-bold">Number :</span><span class="text-muted">{{ (empty($profile->phone)) ? 'not set' :  $profile->phone}}</span>

                                    </h5>
                                    <hr>
                                    <h5 class="gap-3 d-flex"><span class="fw-bold">Address :</span> <span class="text-muted">{{ (empty($profile->address)) ? 'not set' :  $profile->address}}</span></h5>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            @if (empty($profile))
                                                Set Profile
                                            @else
                                                Update Profile
                                            @endif
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ html()->form()
                                            ->id('form-submit-profile')
                                            ->attribute('enctype', 'multipart/form-data')
                                            ->open() }}

                                        <div class="form-group">
                                            {{ html()->label('Profile Image')->for('profile_image') }}
                                            {{ html()->file('pic')->id('pic')->class('form-control') }}
                                        </div>

                                        <div class="form-group">
                                            {{ html()->label('Phone')->for('phone') }}
                                            {{ html()->input('text', 'phone', $profile->phone ?? '')->class('form-control')->id('phone') }}
                                        </div>

                                        <div class="form-group">
                                            {{ html()->label('Address')->for('address') }}
                                            {{ html()->textarea('address', $profile->address ?? '')->class('form-control')->id('address') }}
                                        </div>

                                        {{ html()->hidden('user_id', Auth::user()->id) }}
                                        {{ html()->submit(empty($profile) ? 'Submit' : 'Update')->class('btn select-bgcolor') }}

                                        {{ html()->form()->close() }}
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
       $(document).ready(function(){
        $('#form-submit-profile').on('submit', function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ url('setUrl') }}", // The same controller handles both add and update
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    alert(response.message); // Show success message
                    location.reload(); // Reload the page to reflect changes
                },
                error: function(xhr, status, error){
                    console.error(error);
                    alert("Something went wrong, please try again.");
                }
            });
        });
    });

    </script>
@endsection
