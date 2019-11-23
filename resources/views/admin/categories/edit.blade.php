@extends('layouts.admin')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Edit Categories</div>
        <div class="card-body">
        
            <form action="{{route('categories.update',$decrypt)}}" id="category_form_id" method="POST" enctype="multipart/form-data">
               
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category_name">Name</label>
                    <input type="text" id="category_name" value="{{old('category_name',$categoryData->category_name)}}" class="form-control" placeholder="Name field must be unique" name="category_name">

                    @if($errors->has('category_name'))
                        <span class="error">{{ $errors->first('category_name') }}</span>
                    @endif

                </div>

                


                <div class="form-group">
                    <label for="category_slug">Slug</label>
                    <input type="text" id="category_slug" value="{{old('category_slug',$categoryData->category_slug)}}" class="form-control" name="category_slug">
                    @if($errors->has('category_slug'))
                        <span class="error">{{ $errors->first('category_slug') }}</span>
                    @endif

                </div>

            

                <div class="form-group">
                    <label for="category_description">Description</label>
                    <textarea name="category_description" class="form-control">{{old('category_description',$categoryData->category_description)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">
                        Status
                        <input data-toggle="switch" class="" id="status" data-inverse="true" type="checkbox" name="status" checked>
                    </label>
                </div>
              
                <div class="form-group">
                   
                    <label for="icon">
                        Upload New Logo
                    </label>
                    {{-- <div>
                        <a href="javscript:void(0)"  class="btn btn-primary form-group" data-toggle="modal" data-target="#cropperModal">Upload</a>
                        <div>
                            <img src="" class="img-responsive img-fluid" id="preview_image" style="display: none;"/>
                        </div>
                        @include('modal.imagecropper', ['name' => 'category_icon'])
                    </div> --}}
                    <div>
                        <img id="holder" src="{{$categoryData->category_icon}}" style="margin-bottom:15px;max-height:100px;">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <a id="lfm" data-input="category_icon" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="category_icon" class="form-control" type="text" name="category_icon">
                        </div>
                        @if($errors->has('category_icon'))
                            <span class="error">{{ $errors->first('category_icon') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
    
@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.slugify.js')}}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>

<script>
$('#category_slug').slugify('#category_name');
$('#lfm').filemanager('image');
</script>
{{-- <script type="text/javascript" src={{asset('node_modules/darkroom/vendor/fabric.js')}}></script>
<script type="text/javascript" src={{asset('node_modules/darkroom/build/darkroom.js')}}></script> --}}
{{-- <script src="{{asset('js/imageCropper.js')}}"></script> --}}
@endsection

@endsection
