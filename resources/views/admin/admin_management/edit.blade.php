@extends('admin.layouts.master', ['page_slug' => 'admin'])
@section('title', 'Edit Admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="cart-title">{{ __('Edit Admin') }}</h4>
                    @include('admin.includes.button', [
                            'routeName' => 'admin.index',
                            'label' => 'Back',
                        ])
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" name="name" value="{{ $admin->name }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                placeholder="Enter name">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            <input type="file" accept="image/*" name="image" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}">
                            @include('alerts.feedback', ['field' => 'image'])
                        </div>
                        @if ($admin->image)
                            <img src="{{ asset('storage/' . $admin->image) }}" alt="" width="100" height="100">
                        @endif
                        <div class="form-group">
                            <label>{{ __('Email') }}</label>
                            <input type="text" name="email" value="{{ $admin->email }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                placeholder="Enter email">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter password">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                placeholder="Enter confirm password">
                        </div>
                        <div class="form-group float-end">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
