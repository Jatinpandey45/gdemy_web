@extends('layouts.admin')

@section('content')
{{-- <form action="{{route('posts.store')}}" id="post_form_id" class="row" method="POST" enctype="multipart/form-data"> --}}
    {!! Form::open(['method' => 'POST','id' => 'post_form_id', 'route' => ['quiz.store']]) !!}
    <div class="row">
        <div class="col-md-9">
            <div class="card card-default form-group">
                <div class="card-header h3">
                    Quiz
                    {{-- @lang('quickadmin.create') --}}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('schedule_id', 'Schedule Time*', ['class' => 'control-label']) !!}
                            {!! Form::select('schedule_id', $scheduleTime, old('schedule_id'), ['class' => 'form-control']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('schedule_id'))
                                <p class="help-block">
                                    {{ $errors->first('schedule_id') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
                            {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('slug'))
                                <p class="help-block">
                                    {{ $errors->first('slug') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
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
                    <div class="form-group">
                        <div class="col-xs-12">
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
            <div class="card card-default form-group">
                <div class="card-header h3">Categories</div>
                <div class="card-body">
                    <div class="form-group">
                        @if($category)
                            @foreach($category as $val)
        
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{$val->id}}" name="category[]" id="category_{{$val->id}}">
                                    <span class="cr">
                                        <i class="cr-icon material-icons rtl-no-flip checkbox"></i></span>
                                    </span>
                                    <span class="gk_name">
                                        {{ $val->category_name }}
                                    </span>
                                </label>
                            </div>
                            @endforeach
                        @endif

                        @if($errors->has('category'))
                        <span class="error">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    {!! Form::close() !!}

  
{{-- </form> --}}
<!-- public/js/tiny_mce/plugins/responsivefilemanager -->
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
<script src="{{asset('js/quizpost.js')}}"></script>

@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/flatpick.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom_checkbox.css')}}">
<link rel="stylesheet" href="{{ asset('css/theme.css')}}">
<link rel="stylesheet" href="{{asset('js/tokenized/tokenize2.css')}}">
 @endsection 

 @endsection