@extends('layouts.app')

@section('content')
    <form action="{{route('posts.store')}}" id="category_form_id" class="row" method="POST" enctype="multipart/form-data">
        
        <div class="col-md-9">
            <div class="card card-default">
                <div class="card-header h3">Create Post</div>
                <div class="card-body">
            
                    @csrf
                    <div class="form-group">
                        <label for="post_title">Name</label>
                        <input type="text" id="post_title" value="{{old('post_title')}}" class="form-control" placeholder="Name field must be unique" name="post_title">

                        @if($errors->has('post_title'))
                            <span class="error">{{ $errors->first('post_title') }}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="category_slug">Slug</label>
                        <input type="text" id="category_slug" value="{{old('post_slug')}}" class="form-control" name="post_slug">
                        @if($errors->has('post_slug'))
                            <span class="error">{{ $errors->first('post_slug') }}</span>
                        @endif

                    </div>

                

                    <div class="form-group">
                        <label for="post_desc">Description</label>
                        <input id="post_desc" value="{{old('post_desc')}}" type="hidden" name="post_desc">
                        <trix-editor input="post_desc"></trix-editor>
                    </div>

                    <div class="form-group">
                        <label for="published_at">Published At</label>
                        <input type="text" id="published_at" value="{{old('published_at')}}" class="form-control" name="published_at">
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
                        <img id="loader_element_id" width="100" height="100" style="display:none;position: absolute;margin: -67px 203px -7px;" src="{{asset('images/Spinner-1s-200px.gif')}}">
                    </div> 
                </div>
            </div>
            <div class="card card-default form-group">
                <div class="card-header h3">Categories</div>
                <div class="card-body">
                    <div class="form-group">
                        @if($category)
                            @foreach($category as $val)

                            <div class="radio">
                                <label><input type="radio" name="category" value="{{$val->_id}}"> {{ $val->category_name }}</label>
                            </div>

                            @endforeach
                       
                        @endif
                       
                    </div> 
                </div>
            </div>
            <div class="card card-default form-group">
                <div class="card-header h3">Monthly Categories</div>
                <div class="card-body">
                    <div class="form-group">
                        {{-- <label for="tag_name">Name</label> --}}
                        @if($month)
                            @foreach($month as $val)

                            <div class="radio">
                                <label><input type="radio" name="category" value="{{$val->_id}}"> {{ $val->month_name }}</label>
                            </div>

                            @endforeach
                       
                        @endif
                       
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
<script src="{{asset('js/jQuery-Autocomplete/dist/jquery.autocomplete.min.js')}}"></script>

<script>
    flatpickr('#published_at', {
        enableTime: true
    });

    $('#tag_name').autocomplete({
    serviceUrl: "{{route('post.search.tags')}}",
    minChars: 3,
    dataType: 'json',
    type : "get",
    onSearchStart  : function(){$("#loader_element_id").show();},
    onSearchComplete    : function(){$("#loader_element_id").hide();},
    onSelect: function (suggestion) {
        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
});
</script>
@endsection


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection


@endsection


