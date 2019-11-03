@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header h3">Create Categories</div>
                <div class="card-body">
                
                    <form action="{{route('categories.store')}}" id="category_form_id" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Name</label>
                            <input type="text" id="category_name" value="{{old('category_name')}}" class="form-control" placeholder="Name field must be unique" name="category_name">

                            @if($errors->has('category_name'))
                                <span class="error">{{ $errors->first('category_name') }}</span>
                            @endif

                        </div>

                        


                        <div class="form-group">
                            <label for="category_slug">Slug</label>
                            <input type="text" id="category_slug" class="form-control" name="category_slug">
                            @if($errors->has('category_slug'))
                                <span class="error">{{ $errors->first('category_slug') }}</span>
                            @endif

                        </div>

                    

                        <div class="form-group">
                            <label for="category_description">Description</label>
                            <textarea name="category_description" class="form-control">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">
                                Status
                                <input data-toggle="switch" class="" id="status" data-inverse="true" type="checkbox" name="status" checked>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="icon">
                                Upload Logo
                            </label>
                            <input type="file" class="form-control" name="category_icon">
                            @if($errors->has('category_icon'))
                                <span class="error">{{ $errors->first('category_icon') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header h3">Categories</div>
                    <div class="card-body">
                        <table class="table" id="categor_datatable">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Slug</th>
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

  


@section('pagescript')
<!-- <script src="{{asset('js/jquery-validatioan/dist/jquery.validate.min.js')}}"></script> -->
<!-- <script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script> -->
<!-- <script type="text/javascript" src="{{asset('js/datatable.min.js')}}"></script> -->
<!-- <script src="{{asset('js/category.js')}}"></script> -->


<script type="text/javascript" src="{{asset('js/datatable.min.js')}}"></script>

<script>
   

    var table = $('#categor_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.category.list.records')}}",
    columns: [
        {data: 'category_name', name: 'Category'},
        {data: 'category_description', name: 'Description'},
        {data: 'category_slug', name: 'Slug'},
        {data:"action","render" : function ( data, type, row ){
            return '<a href="'+row.edit_route+'"><i class="material-icons">edit</i></a>'+
                    '<button class="remove-item" data-id="'+data+'"><i class="material-icons">delete</i></button>';
         }
      }
    ]



    });
 
</script>

@endsection




@endsection
