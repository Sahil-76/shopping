@extends('layouts.master')

@push('title')
    <title>Admin Dashboard</title>
@endpush

@section('content')
@php
    $bg = ''; // Default background
    if ($totalProducts < 10) {
        $bg = 'background-color: #f66b6b;'; 
    } 
     else {
        $bg = 'background-color: #37a537b3';
    }
@endphp

<div class="container">
    <div class="row">
        <div class="col-6">
            <a href="{{ route('products.index') }}" class="card text-light"  style="{{ $bg }}">
                <div class="card-header">
                    <h4 style="display: flex; justify-content: space-between;">
                        Total Products <i class="fa-solid fa-cart-shopping"></i>
                    </h4>
                </div>
                <div class="card-body">
                    <h4 style="display: flex; justify-content: space-between;">
                        {{ $totalProducts }}
                    </h4>
                </div>
            </a>
        </div>
        <div class="col-6">
            <div class="card bg-success">
                <div class="card-header">
                    <h4 style="display: flex; justify-content: space-between;">
                        Total Users <i class="fa-solid fa-users"></i>
                    </h4>
                </div>
                <div class="card-body">
                    <h4>{{ $totalUsers }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
        <a href="{{ route('products.index', ['status' =>  Crypt::encrypt('active')]) }}" class="card text-light bg-success">
                <div class="card-header">
                    <h4 style="display: flex; justify-content: space-between;">
                        Active Products <i class="fa-regular fa-eye"></i>
                    </h4>
                </div>
                <div class="card-body">
                    <h4 style="display: flex; justify-content: space-between;">
                        {{ $activeproducts }}
                    </h4>
                </div>
            </a>
        </div>
        <div class="col-6">
        <a href="{{ route('products.index', ['status' => Crypt::encrypt('inactive')]) }}" class="card text-light bg-danger">
                <div class="card-header">
                    <h4 style="display: flex; justify-content: space-between;">
                        Inactive Products <i class="fa-solid fa-eye-slash"></i>
                    </h4>
                </div>
                <div class="card-body">
                    <h4>{{ $inactiveproducts }}</h4>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
@endsection
