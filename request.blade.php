@extends('app.app')
@section('main')
<div class="main-box">
    <div class="container">
        <div class="row">
            <div class="co-md-12">
                <div class="card p-4">
                    <h1 class="select-text-color">Requetes</h1>
                    <hr>
                    <div class="table">
                        <table class="table table-striped table-bordered table-hover border">
                            <thead class="select-bgcolor">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Book Title</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Action</th>
                                <th scope="col">Issued</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($requestData as $value)
                                <tr id="set-{{$value->id}}">
                                    <th scope="row">{{ $loop->index  + 1 }}</th>
                                    <td>{{  $value->book->title }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td class="set">
                                        @if ($value->request == 0)
                                        <button value="{{ $value->id }}" class="btn accept btn-info">Accept</button>
                                        @else
                                        <span class="bg-light p-2">Accepted</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($compare->where('user_id',$value->user_id)->where('book_id',$value->book_id)->first())
                                        <span class="text-white p-2 bg-success">  issued</span>
                                        @else
                                        <span class="text-white p-2 bg-danger"> not issued</span>

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
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.accept').on('click',function(){
                var id  = $(this).val();
                alert(id);
                $.ajax({
                    url:"{{ url('setRequest') }}/"+ id,
                    type:'GET',
                    data:false,
                    processData:false,
                    contentType:false,
                    success:function(response){
                        $('#set-'+ id).find('.set').html(`
                                        <span class="bg-light p-2">Accepted</span>
                        `);
                    }
                })
            })
        })
    </script>
@endsection
