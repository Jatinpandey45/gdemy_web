@extends('layouts.admin')

@section('content')
<form action="{{route('jobs.update',$id)}}" id="post_form_id" class="row" method="POST" enctype="multipart/form-data">

    <div class="col-md-9">
        <div class="card card-default form-group">
            <div class="card-header h3">Create Post</div>
            <div class="card-body">

                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="post_title">Title</label>
                    <input type="text" id="post_title" value="{{old('post_title',$post->post_title)}}" class="form-control" placeholder="Name field must be unique" name="post_title">

                    @if($errors->has('post_title'))
                    <span class="error">{{ $errors->first('post_title') }}</span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="category_slug">Slug</label>
                    <input type="text" id="post_slug" value="{{old('post_slug',$post->post_slug)}}" class="form-control" name="post_slug">
                    @if($errors->has('post_slug'))
                    <span class="error">{{ $errors->first('post_slug') }}</span>
                    @endif

                </div>



                <div class="form-group">
                    <label for="post_desc">Description</label>
                    <!-- <input id="post_desc" type="hidden" name="post_desc">
                        <trix-editor input="post_desc"></trix-editor> -->
                    <textarea class="gk_tinymce" class="validate[required]" rows="30" name="post_desc">{{old('post_desc',$post->post_desc)}}</textarea>
                    @if($errors->has('post_desc'))
                    <span class="error">{{ $errors->first('post_desc') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card card-default form-group">
            <div class="card-header h3">SEO Settings</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="post_seo_title">Title Tag</label>
                    <input type="text" id="post_seo_title" value="{{old('post_seo_title',$post->Seo->keyword)}}" class="form-control enable-counter" placeholder="Name field must be unique" name="post_seo_title">
                    <div class="help-block text-count-wrapper">Most search engine use upto 70</div>
                    @if($errors->has('post_seo_title'))
                    <span class="error">{{ $errors->first('post_seo_title') }}</span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="meta_desc">Meta Description</label>
                    <textarea id="meta_desc" class="form-control enable-counter" name="seo_desc">{{old('seo_desc',$post->Seo->description)}}</textarea>
                    <div class="help-block">Most search engine use upto 140</div>
                    @if($errors->has('seo_desc'))
                    <span class="error">{{ $errors->first('seo_desc') }}</span>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-default form-group ">
            <div class="card-header h3">Publish</div>
            <div class="card-body">
                <div class="form-group row gk-space-between">
                    <button type="submit" class="btn btn-success float-left">Save Draft</button>
                    <a href="javascript:void(0)" class="btn btn-secondary float-right">Preview</a>
                </div>
                <div class="form-group row gk-align-center">
                    <label for="visibility" class="col-md-4 pl-1 pr-1">Visibility</label>
                    <select name="visibility" value="" id="visibility" class="form-control col-md-7">
                        <option value="all">All</option>
                        <option value="android">Android</option>
                        <option value="ios">IOS</option>
                        <option value="web">Web</option>
                    </select>
                </div>


                <div class="form-group row gk-align-center">
                <label for="publish_at" class="col-md-4 pl-1 pr-1">Publish</label>
                    <div id="published_at">
                   
                   
                                <input type="text" name="published_at" readonly="readonly" placeholder="Select Date.." data-input > <!-- input is mandatory -->

                                <a class="input-button" title="toggle" data-toggle>
                                    <i class="material-icons">calendar_today</i>
                                </a>

                                <a class="input-button" title="clear" data-clear>
                                    <i class="material-icons">close</i>
                                </a>
                    </div>


                    @if($errors->has('published_at'))
                    <span class="error">{{ $errors->first('published_at') }}</span>
                    @endif
                </div>

                  
                <div class="form-group row gk-align-center">
                <label for="publish_at" class="col-md-4 pl-1 pr-1">Exprie At</label>
                    <div id="published_at">
                   
                   
                                <input type="text" name="expired_at" readonly="readonly" placeholder="Select Date.." data-input > <!-- input is mandatory -->

                                <a class="input-button" title="toggle" data-toggle>
                                    <i class="material-icons">calendar_today</i>
                                </a>

                                <a class="input-button" title="clear" data-clear>
                                    <i class="material-icons">close</i>
                                </a>
                    </div>


                    @if($errors->has('published_at'))
                    <span class="error">{{ $errors->first('published_at') }}</span>
                    @endif
                </div>



            </div>
        </div>
        <div class="card card-default form-group ">
            <div class="card-header h3">Tag</div>
            <div class="card-body">
          
            <div class="form-group">
                <!-- <input type="text" class="form-control" name="tag_name" id="tag_name"> -->
                <select id="tag_listing_data" class="form-control" name="tag_name[]" multiple="multiple">

                @if($post->Tags)
                    @foreach($post->Tags as $val)
                    <option value="{{$val->id}}" selected="selected">{{$val->tag_name}}</option>
                    @endforeach
                @endif

                </select>
                <img id="loader_element_id" width="100" height="100" style="display:none;position: absolute;margin: -67px 203px -7px;" src="{{asset('images/Spinner-1s-200px.gif')}}">
            </div>
          
        </div>
    </div>

    <div class="card card-default form-group">
        <div class="card-header h3">Featured Image</div>
        <div class="card-body">
            <div class="form-group">
            
                <img id="holder" src="{{asset($post->featured_image)}}" style="margin-bottom:15px;max-height:100px;">
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="lfm" data-input="featured_image" data-preview="holder" class="btn btn-primary">
                          <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                    <input id="featured_image" value="{{$post->featured_image}}" class="form-control" type="text" name="featured_image">
                </div>
                @if($errors->has('featured_image'))
                <span class="error">{{ $errors->first('featured_image') }}</span>
                @endif
                
            </div>
        </div>
    </div>

    </div>
</form>
<!-- public/js/tiny_mce/plugins/responsivefilemanager -->
<input type="hidden" value="{{asset('js/tiny_mce/plugins/responsivefilemanager')}}" id="filemanagerlink" />
<input type="hidden" value="{{route('post.search.tags')}}" id="tag_search_request_route">
<input type="hidden" value="{{route('post.admin.search.search')}}" id="serrach_tag_seo">
<input type="hidden" value="{{route('post.add.new.tag')}}" id="add_new_tag_from_post_id">

@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script src="{{asset('js/category.js')}}"></script>
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>
<script src="{{asset('js/flatpick.js')}}"></script>
<script src="{{asset('js/jquery.autocomplete.js')}}"></script>
<script src="{{asset('js/tokenized/tokenize2.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.slugify.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('node_modules/darkroom/vendor/fabric.js')}}"></script>
<script type="text/javascript" src="{{asset('node_modules/darkroom/build/darkroom.js')}}"></script> --}}
<script src="{{asset('js/posts/jobpostcreate.js')}}"></script>
{{-- <script src="{{asset('js/imageCropper.js')}}"></script> --}}
@endsection

@section('css')
{{-- <link rel="stylesheet" href="{{asset('node_modules/darkroom/build/darkroom.css')}}"> --}}
<link rel="stylesheet" href="{{asset('css/flatpick.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom_checkbox.css')}}">
<link rel="stylesheet" href="{{ asset('css/theme.css')}}">
<link rel="stylesheet" href="{{asset('js/tokenized/tokenize2.css')}}">
 @endsection 

 @endsection