<!-- resources/views/auth/password_reset.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="page-header align-items-start min-vh-100"
         style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8MHx8&auto=format&fit=crop&w=1950&q=80');"
         loading="lazy">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                             style="background-color: #F6FB7A">
                            <div class="text-center">
                                <img src="{{ asset('img/qec.png') }}" class="w-50" alt="main_logo">
                                <h6 class="font-weight-normal mb-2 text-xs">Reset Password</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.reset') }}">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" required autofocus>
                                </div>
