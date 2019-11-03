@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Create Categories</div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>            
            @endif
            <form action="{{route('categories.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="category_name">Name</label>
                    <input type="text" id="category_name" class="form-control" name="category_name">
                </div>
                <div class="form-group">
                    <label for="category_slug">Slug</label>
                    <input type="text" id="category_slug" class="form-control" name="category_slug">
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
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
