@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header h3">Create Categories</div>
                <div class="card-body">
                
                    <form action="{{route('categories.store')}}" id="category_form_id" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Name</label>
                            <input type="text" id="category_name" value="{{old('category_name')}}" class="form-control" placeholder="Name field must be unique" name="category_name">

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
                            <label for="category_description">Description</label>
                            <textarea name="category_description" class="form-control">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">
                                Status
                                <input data-toggle="switch" class="" id="status" data-inverse="true" type="checkbox" name="status" checked>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="icon">
                                Upload Logo
                            </label>
                            <input type="file" class="form-control" name="category_icon">
                            @if($errors->has('category_icon'))
                                <span class="error">{{ $errors->first('category_icon') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header h3">Categories</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Slug</th>
                                <th>Count</th>
                            </thead>
                            <tbody>
                                <td>
                                    Name
                                    <div>
                                        <a href="{{ route('categories.edit', 1) }}">Edit</a>
                                        <a href="{{ route('categories.destroy', 1) }}">Trash</a>
                                    </div>
                                </td>
                                <td>Test Description</td>
                                <td>Test Slug</td>
                                <td>Count</td>
                                {{-- @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category.name }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>

<script src="{{asset('js/category.js')}}"></script>

@endsection




@endsection
