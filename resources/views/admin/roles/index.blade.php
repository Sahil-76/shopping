@extends('layouts.master')
@push('title')
    <title>roles</title>
@endpush
@section('content')
<div class="container">
    <div class="table-responsive">
        <a href="{{ route('roles.create') }}" class="btn btn-success">Add New Role</a>
        <table class="table" id="roles">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                @php
                $name=Crypt::decrypt($role->name);
                @endphp
                <tr class="">
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $name }}</td>
                    <td>{{ \Carbon\Carbon::parse($role->created_at)->setTimeZone('Asia/KolKata')->format('d-M-Y h:i: A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $('#roles').DataTable({
                paging:true,
                searching:true,
                ordering:true,
            })
        });
    </script>
@endsection


