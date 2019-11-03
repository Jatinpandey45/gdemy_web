@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Edit Tags</div>
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
                    <textarea name="tag_desc" class="form-control">
                    </textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update Tag</button>
                </div>
            </form>
        </div>
    </div>
    
@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>

@endsection




@endsection
