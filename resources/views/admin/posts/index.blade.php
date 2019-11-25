@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
            </div>
            <div class="card card-default">
                <div class="card-header h3">Posts</div>
                    <div class="card-body">
                        <table class="table" id="data_table_post">
                            <thead>
                                <th>Title</th>
                                {{-- <th>Description</th> --}}
                                <th>Month</th>
                                <th>Published At</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.delete', ['type' => 'post'])


@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datatable.min.js')}}"></script>
<script>
  var table = $('#data_table_post').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.post.list.records')}}",
    columns: [
        {data: 'post_title', name: 'Category'},
        // {data: 'post_desc', name: 'Description','orderable':false},
        {data: 'month', name: 'Month','orderable' :false},
        {data: 'publish_at', name: 'Created'},
        {data:"action","className": "text-right", "render" : function ( data, type, row ){
            return '<a href="'+row.edit_route+'"><i class="material-icons">edit</i></a>'+
                '<a href="javascript:void(0);" class="remove-item" data-id="'+data+'"><i class="material-icons" data-toggle="modal" data-target="#deleteModal">delete</i></a>';
         }
      }
    ]
    });
    $( table.table().container() )
    .addClass( 'table table-responsive



</script>
@endsection




@endsection
