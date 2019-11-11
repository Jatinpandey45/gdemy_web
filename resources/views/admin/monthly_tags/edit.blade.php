@extends('layouts.admin')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Create Monthly Tags</div>
        <div class="card-body">
         
            <form action="{{route('monthly.update',$decrypt)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="month_name">Name</label>
                    <input type="text" id="month_name" value="{{old('month_name',$month->month_name)}}" class="form-control" name="month_name">

                    @if($errors->has('month_name'))
                        <span class="error">{{ $errors->first('month_name') }}</span>
                    @endif
               
               
               
                </div>
                <div class="form-group">
                    <label for="month_slug">Slug</label>
                    <input type="text" id="month_slug" value="{{old('month_slug',$month->month_slug)}}" class="form-control" name="month_slug">

                    @if($errors->has('month_slug'))
                        <span class="error">{{ $errors->first('month_slug') }}</span>
                    @endif
               
                 </div>
                <div class="form-group">
                    <label for="month_desc">Description</label>
                    <textarea name="month_desc" class="form-control">{{old('month_name',$month->month_desc)}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">update</button>
                </div>
            </form>
        </div>
    </div>


@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.slugify.js')}}"></script>
<script>
 $('#month_slug').slugify('#monthly_name');
</script>

@endsection


@endsection
