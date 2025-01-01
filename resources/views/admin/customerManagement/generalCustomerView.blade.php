@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="profile-image">Customer Profile</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                            <img class="profile-pic img-fluid rounded-circle" src="{{ $user->avatar ? asset('/' . $user->avatar) : 'https://via.placeholder.com/150' }}" alt="Profile Picture" width="150" style="cursor: pointer;" onclick="document.getElementById('profile-picture-input').click();">
                                <div class="mt-2">
                                    <form action="{{ route('customers-profile.image') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $user->id }}" class="form-control">
                                        <input type="file" id="profile-picture-input" name="avatar" class="d-none form-control" accept="image/*" onchange="previewImage(event)">
                                        <button type="submit" class="btn btn-primary" >Change Profile Picture</button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <h5>Name: {{ $user->name }}</h5>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
                                <p><strong>Address:</strong> {{ $user->address }}</p>
                                <p><strong>Account Type:</strong> @if($user->account_type=='G')<span class="badge badge-success">General</span>@endif</p>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            // Update the profile picture with the selected image
            document.getElementById('profile-pic').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush