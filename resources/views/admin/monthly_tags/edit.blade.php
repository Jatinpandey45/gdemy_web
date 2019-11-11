@extends('layouts.admin')

@section('content')
    <div class="card card-default">
        <div class="card-header h3">Create Monthly Tags</div>
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
            <form action="{{route('monthly.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="month_name">Name</label>
                    <input type="text" id="month_name" class="form-control" name="month_name">
                </div>
                <div class="form-group">
                    <label for="month_slug">Slug</label>
                    <input type="text" id="month_slug" readonly="readonly" class="form-control" name="month_slug">
                </div>
                <div class="form-group">
                    <label for="month_desc">Description</label>
                    <textarea name="month_desc" class="form-control">
                    </textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">Add Monthly Tags</button>
                </div>
            </form>
        </div>
    </div>


@section('pagescript')
<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.slugify.js')}}"></script>
<script>
 $('#month_slug').slugify('#monthly_name');
</script>

@endsection


@endsection
