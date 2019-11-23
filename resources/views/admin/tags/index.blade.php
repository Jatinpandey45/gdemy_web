@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header h3">Create Tag</div>
                <div class="card-body">
                
                    <form action="{{route('tags.store')}}" id="category_form_id" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tag_name">Name</label>
                            <input type="text" id="tag_name" value="{{old('tag_name')}}" class="form-control" placeholder="Name field must be unique" name="tag_name">

                            @if($errors->has('tag_name'))
                                <span class="error">{{ $errors->first('tag_name') }}</span>
                            @endif

                        </div>

                        


                        <div class="form-group">
                            <label for="tag_slug">Slug</label>
                            <input type="text" id="tag_slug" class="form-control" name="tag_slug">
                            @if($errors->has('tag_slug'))
                                <span class="error">{{ $errors->first('tag_slug') }}</span>
                            @endif

                        </div>

                    

                        <div class="form-group">
                            <label for="tag_desc">Description</label>
                            <textarea name="tag_desc" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header h3">Tags</div>
                    <div class="card-body">
                        <table class="table" id="tag_datatable">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Slug</th>
                                <th class="text-right">Action</th>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.delete', ['type' => 'tag'])
  


@section('pagescript')
<script src="{{asset('js/jquery.validate.min.js')}}"></script> 
<script src="{{asset('js/additional-methods.min.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datatable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.slugify.js')}}"></script>

<script>
   

    var table = $('#tag_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.tag.list')}}",
    columns: [
        {data: 'tag_name', name: 'Category'},
        {data: 'tag_desc', name: 'Description'},
        {data: 'tag_slug', name: 'Slug'},
        {data:"action","className": "text-right", "render" : function ( data, type, row ){
            return '<a href="'+row.edit_route+'"><i class="material-icons">edit</i></a>'+
                '<a href="javascript:void(0);" class="remove-item" data-id="'+data+'"><i class="material-icons">delete</i></a>';
         },
         'orderable': false,
        "sortable":false,
      }
    ]
    });

    $('#tag_slug').slugify('#tag_name');

    var REMOVE_DATA_FROM_TABLE = {


__REMOVE_FROM_LIST: function(type, id) {

    $.ajax({
        type: "get",
        url: $("#trash_route").val(),
        data: {
            type: type,
            id: id
        },
        dataType: "json",
        success: function(response) {

            console.log(response);

            table
                .row($(this).parents('tr'))
                .remove()
                .draw();

            swal("Your tags has been moved to trash!", {
                icon: "success",
            });

        }
    });

}
}



$('body').on('click', '.remove-item', function() {

swal({
        title: "Are you sure?",
        text: "Once deleted, you will be able to recover this post from trash!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            var id = $(this).attr('data-id');
            REMOVE_DATA_FROM_TABLE.__REMOVE_FROM_LIST("tags", id);
        }
    });

});
 
</script>

@endsection




@endsection
