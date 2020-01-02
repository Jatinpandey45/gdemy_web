@extends('layouts.admin')

@section('content')
<form action="{{route('quiz.store')}}" id="post_form_id" class="row" method="POST" enctype="multipart/form-data">
    {!! Form::open(['method' => 'POST', 'route' => ['questions.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('topic_id', 'Topic*', ['class' => 'control-label']) !!}
                    {!! Form::select('topic_id', $topics, old('topic_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('topic_id'))
                        <p class="help-block">
                            {{ $errors->first('topic_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question_text', 'Question text*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('question_text', old('question_text'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question_text'))
                        <p class="help-block">
                            {{ $errors->first('question_text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option1', 'Option #1', ['class' => 'control-label']) !!}
                    {!! Form::text('option1', old('option1'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option1'))
                        <p class="help-block">
                            {{ $errors->first('option1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option2', 'Option #2', ['class' => 'control-label']) !!}
                    {!! Form::text('option2', old('option2'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option2'))
                        <p class="help-block">
                            {{ $errors->first('option2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option3', 'Option #3', ['class' => 'control-label']) !!}
                    {!! Form::text('option3', old('option3'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option3'))
                        <p class="help-block">
                            {{ $errors->first('option3') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option4', 'Option #4', ['class' => 'control-label']) !!}
                    {!! Form::text('option4', old('option4'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option4'))
                        <p class="help-block">
                            {{ $errors->first('option4') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option5', 'Option #5', ['class' => 'control-label']) !!}
                    {!! Form::text('option5', old('option5'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option5'))
                        <p class="help-block">
                            {{ $errors->first('option5') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('correct', 'Correct', ['class' => 'control-label']) !!}
                    {!! Form::select('correct', $correct_options, old('correct'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('correct'))
                        <p class="help-block">
                            {{ $errors->first('correct') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('code_snippet', 'Code snippet', ['class' => 'control-label']) !!}
                    {!! Form::textarea('code_snippet', old('code_snippet'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('code_snippet'))
                        <p class="help-block">
                            {{ $errors->first('code_snippet') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('answer_explanation', 'Answer explanation*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('answer_explanation', old('answer_explanation'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('answer_explanation'))
                        <p class="help-block">
                            {{ $errors->first('answer_explanation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('more_info_link', 'More info link', ['class' => 'control-label']) !!}
                    {!! Form::text('more_info_link', old('more_info_link'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('more_info_link'))
                        <p class="help-block">
                            {{ $errors->first('more_info_link') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <div class="col-md-9">
        <div class="card card-default form-group">
            <div class="card-header h3">Create Question</div>
            <div class="card-body">

                @csrf
                <div class="form-group">
                    <label for="post_title">Title</label>
                    <input type="text" id="post_title" value="{{old('post_title')}}" class="form-control" placeholder="Name field must be unique" name="post_title">

                    @if($errors->has('post_title'))
                    <span class="error">{{ $errors->first('post_title') }}</span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="category_slug">Slug</label>
                    <input type="text" id="post_slug" value="{{old('post_slug')}}" class="form-control" name="post_slug">
                    @if($errors->has('post_slug'))
                    <span class="error">{{ $errors->first('post_slug') }}</span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="post_desc">Short Description</label>
                    <textarea class="form-control" class="validate[required]" rows="5" name="post_short_desc">{{old('post_short_desc')}}</textarea>
                    @if($errors->has('post_short_desc'))
                    <span class="error">{{ $errors->first('post_short_desc') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="post_desc">Description</label>
                    <!-- <input id="post_desc" type="hidden" name="post_desc">
                        <trix-editor input="post_desc"></trix-editor> -->
                    <textarea class="gk_tinymce" class="validate[required]" rows="30" name="post_desc">{{old('post_desc')}}</textarea>
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
                    <input type="text" id="post_seo_title" value="{{old('post_seo_title')}}" class="form-control enable-counter" placeholder="Name field must be unique" name="post_seo_title">
                    <div class="help-block text-count-wrapper">Most search engine use upto 70</div>
                    @if($errors->has('post_seo_title'))
                    <span class="error">{{ $errors->first('post_seo_title') }}</span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="meta_desc">Meta Description</label>
                    <textarea id="meta_desc" class="form-control enable-counter" name="seo_desc">{{old('seo_desc')}}</textarea>
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
            </div>
        </div>
        <div class="card card-default form-group ">
            <div class="card-header h3">Tag</div>
            <div class="card-body">
                {{-- <label for="tag_name">Name</label> --}}
                {{-- <div class="form-group">
                        <select id="tag_listing_data" name="tag_name[]" multiple="multiple"></select>
                        <img id="loader_element_id" width="100" height="100" style="display:none;position: absolute;margin: -67px 203px -7px;" src="{{asset('images/Spinner-1s-200px.gif')}}">
            </div> --}}


            <div class="form-group">
                <!-- <input type="text" class="form-control" name="tag_name" id="tag_name"> -->
                <select id="tag_listing_data" class="form-control" name="tag_name[]" multiple="multiple"></select>
                <img id="loader_element_id" width="100" height="100" style="display:none;position: absolute;margin: -67px 203px -7px;" src="{{asset('images/Spinner-1s-200px.gif')}}">
            </div>
            <div class="input-group" id="selected_post_tag">
                <select type="hidden" class="d-none" name="post_tags" id="post_tags" value=""/>
                </select>
            </div>
            
            <input type="hidden" name="selected_id" id="selected_tag"/>
            <input type="hidden" name="selected_name" id="selected_tag_name"/>
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
    {{-- </div> --}}
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
<script src="{{asset('js/posts/createpost.js')}}"></script>
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