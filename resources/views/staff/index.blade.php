@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10">

            <h1>Senarai Staff</h1>
        </div>
        <div class="col-2">
            <a href="/staffs/create" class="btn btn-outline-primary float-end">Create New</a>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffs as $key => $staff)
                        <tr>
                            <td>{{ $staffs->firstItem() + $key }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/staffs/{{ $staff->id }}/edit" class="btn mx-2 btn-warning">Edit</a>
                                    <a href="/staffs/{{ $staff->id }}" class="btn mx-2 btn-info">View</a>
                                    <form action="/staffs/{{ $staff->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn mx-2 btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No Staff</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $staffs->links() }}
        </div>
    </div>
@endsection
