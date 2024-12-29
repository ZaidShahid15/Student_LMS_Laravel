<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-md-5  col-lg-4">
                    <div class="card  p-4 bg-light ">
                        <h2 class="text-center fw-bold select-text-color text-uppercase">Register Account</h2>
                        @include('messeg')
                        <hr>
                        <form action="{{ route('register.user') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="select-text-color">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control shadow-none @error('name')
                                    is-invalid
                                @enderror">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                           <div class="fomr-group">
                            <label for="" class="select-text-color">Email <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">@</span>
                                <input type="email" name="email" class="form-control shadow-none @error('email')
                                    is-invalid
                                @enderror">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                           </div>
                            <div class="form-group mb-3">
                                <label for="" class="select-text-color">Password <span class="text-danger">*</span></label>
                                <input type="text" name="password" class="form-control shadow-none @error('password')
                                    is-invalid
                                @enderror">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="select-text-color">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="confirm_password" class="form-control shadow-none @error('confirm_password')
                                    is-invalid
                                @enderror">
                                @if ($errors->has('confirm_password'))
                                    <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('login') }}" style="font-size: 14px;"  class="text-decoration-none mb-3">have an account?</a>
                            <button type="submit" class="bnt select-bgcolor p-1 btn-primary mt-3 w-100 border-0">Register</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
