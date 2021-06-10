@extends('layouts.master')
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>User Management Control</h3>
                    <p class="text-subtitle text-muted">For user to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Mangement</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if(\Session::has('update'))
            <div class="alert alert-success">
                <h4 class="alert-heading">Success</h4>
                <p> {!! \Session::get('update') !!}</p>
            </div>
        @endif
        
        <section class="section">
            <div class="card">
                <div class="card-header">
                    User Datatable
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Role Name</th>
                                <th class="text-center">Modify</th>
                            </tr>    
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="id">{{ $item->id }}</td>
                                    <td class="name">{{ $item->name }}</td>
                                    <td class="email">{{ $item->email }}</td>
                                    <td class="phone_number">{{ $item->phone_number }}</td>
                                    @if($item->status =='Active')
                                    <td class="status"><span class="badge bg-success">{{ $item->status }}</span></td>
                                    @endif
                                    @if($item->status =='Disable')
                                    <td class="status"><span class="badge bg-danger">{{ $item->status }}</span></td>
                                    @endif
                                    @if($item->status ==null)
                                    <td class="status"><a href="javascript:void(0)" class="badge badge-pill badge-danger">{{ $item->status }}</a></td>
                                    @endif
                                    @if($item->role_name =='Admin')
                                    <td class="role_name"><a href="javascript:void(0)" class="badge badge-pill badge-success">{{ $item->role_name }}</a></td>
                                    @endif
                                    @if($item->role_name =='Normal User')
                                    <td class="role_name"><a href="javascript:void(0)" class="badge badge-pill badge-secondary">{{ $item->role_name }}</a></td>
                                    @endif
                                    @if($item->role_name =='')
                                    <td class="role_name"><span class="badge bg-warning">{{'[N/A]'}}</span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ url('view/detail/'.$item->id) }}">
                                            <span class="badge bg-success">Update</span>
                                        </a>  
                                        <a href="{{ url('delete/'.$item->id) }}" onclick="return confirm('Are you sure to want to delete it?')"><span class="badge bg-danger">Delete</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('script')
<script>
let table1 = document.querySelector('#table1');
let dataTable = new simpleDatatables.DataTable(table1);
</script>
@endsection
