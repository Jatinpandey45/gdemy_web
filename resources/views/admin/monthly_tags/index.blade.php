@extends('layouts.app')

@section('content')
    <button></button>
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('monthly.create') }}" class="btn btn-success float-right">
            Add Monthly Tags
        </a>
    </div>
    <div class="card card-default">
        <div class="card-header">Monthly Tags</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Name</th>
                </thead>
                <tbody>
                    {{-- @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category.name }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
