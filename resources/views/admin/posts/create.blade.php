@extends('layouts.app')

@section('content')
    <form action="{{route('categories.store')}}" id="category_form_id" class="row" method="POST" enctype="multipart/form-data">
        <div class="col-md-9">
            <div class="card card-default">
                <div class="card-header h3">Create Post</div>
                <div class="card-body">
            
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
                        <input id="post_desc" type="hidden" name="post_desc">
                        <trix-editor input="post_desc"></trix-editor>
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
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-default form-group ">
                <div class="card-header h3">Publish</div>
                <div class="card-body">
                    <div class="form-group">
                        
                    </div> 
                </div>
            </div>            
            <div class="card card-default form-group ">
                <div class="card-header h3">Tag</div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="tag_name">Name</label> --}}
                        <input type="text" id="tag_name" value="" class="form-control" placeholder="" name="tag_name">
                    </div> 
                </div>
            </div>
            <div class="card card-default form-group">
                <div class="card-header h3">Categories</div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="tag_name">Name</label> --}}
                        <div class="radio">
                            <label><input type="radio" name="category" checked> Option 1</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="category"> Option 2</label>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="card card-default form-group">
                <div class="card-header h3">Monthly Categories</div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="tag_name">Name</label> --}}
                        <div class="radio">
                            <label><input type="radio" name="monthlyca" checked> Option 1</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="monthlyca"> Option 2</label>
                        </div>
                    </div> 
                </div>
            </div>
            {{-- <div class="card card-defaut">
                
            </div>
            <div class="card card-defaut">
            </div>
            <div class="card card-defaut">
            </div>
            <div class="card card-defaut">
            </div> --}}
        </div>
    </form>
    {{-- <div class="row">
    </div> --}}
@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>

<script src="{{asset('js/category.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true
    });
</script>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection


@endsection


