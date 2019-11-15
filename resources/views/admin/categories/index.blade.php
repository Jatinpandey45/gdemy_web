@extends('layouts.admin')

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
                            <textarea name="category_description" class="form-control"></textarea>
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
                            {{-- <input type="file" class="form-control" name="category_icon"> --}}
                            <div>
                                <a href="javscript:void(0)"  class="btn btn-primary" data-toggle="modal" data-target="#cropperModal">Upload</a>
                                @include('modal.imagecropper', ['name' => 'category_icon'])
                            </div>
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
                        <table class="table" id="category_datatable">
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
    @include('modal.delete', ['type' => 'category'])  


@section('pagescript')
<script src="{{asset('js/jquery.validate.min.js')}}"></script> 
<script src="{{asset('js/additional-methods.min.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datatable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.slugify.js')}}"></script>

<script>
   

    var table = $('#category_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.category.list.records')}}",
    columns: [
        {data: 'category_name', name: 'Category'},
        {data: 'category_description', name: 'Description'},
        {data: 'category_slug', name: 'Slug'},
        {data:"action","className": "text-right", "render" : function ( data, type, row ){
            return '<a href="'+row.edit_route+'"><i class="material-icons">edit</i></a>'+
                '<a href="javascript:void(0);" class="remove-item" data-id="'+data+'"><i class="material-icons" data-toggle="modal" data-target="#deleteModal">delete</i></a>';
         }
      }
    ]
    });
    $('#category_slug').slugify('#category_name');
   
</script>

@endsection




@endsection
