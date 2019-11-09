@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
            </div>
            <div class="card card-default">
                <div class="card-header h3">Posts</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>Month</th>
                                <th>Comments</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <td>
                                    Title
                                    <div>
                                        <a href="{{ route('categories.edit', 1) }}">Edit</a>
                                        <a href="{{ route('categories.destroy', 1) }}">Trash</a>
                                    </div>
                                </td>
                                <td>Post Description</td>
                                <td>Categories</td>
                                <td>Tags</td>
                                <td>Month</td>
                                <td>Comments</td>
                                <td>Status</td>
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
