@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Create Tags</div>
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
            <form action="{{route('tags.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tags_name">Name</label>
                    <input type="text" id="tags_name" class="form-control" name="tags_name">
                </div>
                <div class="form-group">
                    <label for="tags_slug">Slug</label>
                    <input type="text" id="tags_slug" class="form-control" name="tags_slug">
                </div>
                <div class="form-group">
                    <label for="tags_desc">Description</label>
                    <textarea name="tags_desc" class="form-control">
                    </textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Add Tags</button>
                </div>
            </form>
        </div>
    </div>
@endsection
