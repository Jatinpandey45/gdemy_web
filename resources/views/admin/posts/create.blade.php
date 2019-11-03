@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Create Post</div>
        <div class="card-body">
        
            <form action="{{route('categories.store')}}" id="category_form_id" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="post_title">Name</label>
                    <input type="text" id="post_title" value="{{old('post_title')}}" class="form-control" placeholder="Name field must be unique" name="post_title">

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
                    <label for="post_desc">Description</label>
                    <textarea name="post_desc" rows="5" cols="5" class="form-control">
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" id="published_at" class="form-control" name="published_at">
                    @if($errors->has('published_at'))
                        <span class="error">{{ $errors->first('published_at') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="featured_image">Feature Image</label>
                    <input type="file" id="featured_image" class="form-control" name="featured_image">
                    @if($errors->has('featured_image'))
                        <span class="error">{{ $errors->first('featured_image') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Post</button>
                </div>
            </form>
        </div>
    </div>
@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>

<script src="{{asset('js/category.js')}}"></script>

@endsection




@endsection
