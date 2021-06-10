@extends('layouts.master')
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>User Management View</h3>
            <p class="text-subtitle text-muted">For user to check they list</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Mangement View</li>
                </ol>
            </nav>
        </div>
    </div>
</div> 

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User View Detial</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="{{ route('update') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="id" value="{{ $data[0]->id }}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Full Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Name" id="first-name-icon" name="fullName" value="{{ $data[0]->name }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Email Address</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="email" class="form-control"
                                            placeholder="Email" id="first-name-icon" name="email" value="{{ $data[0]->email }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Mobile Number</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="number" class="form-control"
                                            placeholder="Mobile" name="phone_number" value="{{ $data[0]->phone_number }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-phone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Status" name="status" value="{{ $data[0]->status }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-app-indicator"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Role Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control"
                                            placeholder="Role Name" name="role_name" value="{{ $data[0]->role_name }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                    class="btn btn-primary me-1 mb-1">Update</button>
                                <a  href="{{ URL::to('/users') }}"
                                    class="btn btn-light-secondary me-1 mb-1">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection