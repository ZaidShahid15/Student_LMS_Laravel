@extends('app.app')
@section('main')
    <div class="main-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5">
                        <h1 class="justify-content-between text-set heading fw-bold  d-flex "><span class="select-text-color">Add    Category</span></h1>
                    <hr>
                        <table class="table border table-bordered table-striped table-hover">
                            <thead class="select-bgcolor">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Book</th>
                                <th scope="col">Auther</th>
                                <th scope="col">Issue Data</th>
                                <th scope="col">Due Data</th>
                                <th scope="col">Return At</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($booksShow as $key)
                                <tr id="row-{{ $key->id }}">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $key->book->title }}</td>
                                    <td>{{ $key->students->name }}</td>
                                    <td>{{ $key->issued_at }}</td>
                                    <td>{{ $key->due_date }}</td>
                                    <td class="returned">
                                        @if($key->returned_at === '0000-00-00')
                                        <button value="{{ $key->id }}" class="btn return btn-info">Return_now</button>
                                        @else
                                        <span class="p-1 bg-light text-success">Returned</span> <br> {{ $key->returned_at }}
                                        @endif
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
@endsection
@section('script')
    <script>
        $('.return').on('click', function() {
            var id  =  $(this).val();
            $.ajax({
                url:"{{ url('return') }}/"+id,
                type:"GET",
                data:false,
                processData: false,
                contentType: false,
                success:function(response){
                    if(response.success){
                        var row = $('#row-'+ id);
                        row.find('.returned').html('<span class="p-1 bg-light text-success">Returned</span>' + `<br>` + response.data.returned_at )
                    }
                }
            });
        })
    </script>
@endsection
