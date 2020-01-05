@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <a href="{{ route('quiz.create') }}" class="btn btn-primary">Create Quiz</a>
           
        </div>
        {{-- <h2>Total Posts : {{isset($count)}} {{ $count }} </h2> --}}
        <div class="card card-default">
            <div class="card-header h3">Posts</div>

            <div class="card-body">
                <table class="table" id="data_table_post">
                    <thead>
                        <th>Title</th>
                        {{-- <th>Description</th> --}}
                        <th>Month</th>
                        <th>Published At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{-- {{$page ?? ''->links()}}
                <input type="hidden" value="{{$page ?? ''->currentPage()}}" id="get_current_page"> --}}
            </div>
        </div>
    </div>
</div>
</div>
@include('modal.delete', ['type' => 'post'])
<input type="hidden" id="route_post_list" value="{{route('admin.post.list.records')}}">


@section('pagescript')

<script src="{{asset('js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/jquery-validation/dist/additional-methods.min.js')}}"></script>
<script src="{{asset('js/datatable.min.js')}}"></script>
<script src="{{asset('js/post.list.js')}}"></script>

@endsection




@endsection