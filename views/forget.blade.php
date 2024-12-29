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
                    <div class="card p-4 bg-light shadow">
                        <h4 class="text-center text-uppercase">Find Email</h4>
                        @include('messeg')
                        <hr>
                        {{ html()->form('get',route('findemail'))->open() }}
                        {{ html()->label('Email')->class('form-label') }}
                        {{ html()->email('email')->class('form-control ')->placeholder('Email') }}
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        {{ html()->submit('submit')->class('form-control mt-3 shadow-none select-bgcolor') }}
                        {{ html()->form()->close() }}

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
