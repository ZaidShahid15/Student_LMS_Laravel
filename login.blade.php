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
                <div class="col-md-4">
                    <div class="card p-4 bg-light ">
                        <h1 class="text-center text-uppercase fw-bold select-text-color">Login</h1>
                        @include('messeg')
                        <hr>
                        <form action="{{ route('login.user') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="select-text-color">Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control shadow-none">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="select-text-color">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control shadow-none">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('forget.password') }}" class="text-decoration-none mb-3">forget password?</a>
                            <button type="submit" class="bnt p-1  select-bgcolor mt-3 mb-3 w-100 rounded-0 border-0">LOGIN</button>
                            <a href="{{ route('regiester') }}" class="text-decoration-none mb-3">create an account</a>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
