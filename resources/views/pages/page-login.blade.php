@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="authincation h-100">
            <div class="container-fluid h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <h4 class="text-center mb-4">Sign in your account</h4>
                                        <form action="#">
                                            <div class="form-group">
                                                <label><strong>Email</strong></label>
                                                <input type="email" class="form-control" value="hello@example.com">
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Password</strong></label>
                                                <input type="password" class="form-control" value="Password">
                                            </div>
                                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                                <div class="form-group">
                                                    <div class="form-check ml-2">
                                                        <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                        <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="#">Forgot Password?</a>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Sign me in</button>
                                            </div>
                                        </form>
                                        <div class="new-account mt-3">
                                            <p>Don't have an account? <a class="text-primary" href="{{route('page-register')}}">Sign up</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection