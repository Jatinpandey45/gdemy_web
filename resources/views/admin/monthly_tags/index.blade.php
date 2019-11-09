@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header h3">Monthly Tag</div>
                <div class="card-body">
                
                    <form action="{{route('monthly.store')}}" id="monthly_form_id" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="monthly_name">Name</label>
                            <input type="text" id="monthly_name" value="{{old('month_name')}}" class="form-control" placeholder="Name field must be unique" name="month_name">

                            @if($errors->has('month_name'))
                                <span class="error">{{ $errors->first('month_name') }}</span>
                            @endif

                        </div>                  

                        <div class="form-group">
                            <label for="monthly_slug">Slug</label>
                            <input type="text" id="monthly_slug" value="{{old('month_slug')}}" class="form-control" name="month_slug">
                            @if($errors->has('month_slug'))
                                <span class="error">{{ $errors->first('month_slug') }}</span>
                            @endif

                        </div>

                    

                        <div class="form-group">
                            <label for="monthly_desc">Description</label>
                            <textarea name="month_desc" class="form-control">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add Monthly Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header h3">Monthly Tags</div>
                    <div class="card-body">
                        <table class="table" id="monthly_datatable">
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

  


@section('pagescript')
<script src="{{asset('js/jquery.validate.min.js')}}"></script> 
<script src="{{asset('js/additional-methods.min.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datatable.min.js')}}"></script>

<script>
   

    var table = $('#monthly_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{route('admin.month.list')}}",
    columns: [
        {data: 'month_name', name: 'Month'},
        {data: 'month_desc', name: 'Description'},
        {data: 'month_slug', name: 'Slug'},
        {data:"action","className": "text-right", "render" : function ( data, type, row ){
            return '<a href="'+row.edit_route+'"><i class="material-icons">edit</i></a>'+
                '<a href="javascript:void(0);" class="remove-item" data-id="'+data+'"><i class="material-icons">delete</i></a>';
         }
      }
    ]



    });
 
</script>

@endsection




@endsection
