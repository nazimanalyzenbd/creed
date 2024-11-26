@extends('layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Admin User</h4>
                    </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control" placeholder="" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Phone Number<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone_number" id="phone_number" value="{{old('phone_number')}}" class="form-control" placeholder="" required>
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control" placeholder="" required>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Confirm Password<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirm-password" id="password" value="{{old('password')}}" class="form-control" placeholder="Confirm Password" required>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Address<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="form-row">
                                                <div class="col-sm-4">
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select id="country" name="country" class="form-control select2" required>
                                                        <option>Select Country..</option>
                                                        @foreach($country as $list)
                                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select id="state" name="state" class="form-control select2">
                                                        <option value="">Select State</option>
                                                    </select>
                                                </div>
                                                <div class="col mt-2 mt-sm-0">
                                                    <select id="city" name="city" class="form-control select2">
                                                        <option value="">Select City</option>
                                                    </select>
                                                </div>
                                                <div class="col mt-2 mt-sm-0">
                                                    <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="Zip Code" required>
                                                </div>
                                            </div>
                                            @error('zip_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Role<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <select name="roles" class="form-control select2">
                                                @foreach ($roles as $value => $label)
                                                    <option value="{{ $value }}">
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('country').addEventListener('change', function () {
        const countryId = this.value;
        if (countryId) {
            fetch(`/states/${countryId}`)
                .then(response => response.json())
                .then(data => {
                    const stateDropdown = document.getElementById('state');
                    stateDropdown.innerHTML = '<option value="">Select State</option>';
                    data.forEach(state => {
                        stateDropdown.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                    });
                    stateDropdown.disabled = false;
                });
        }
    });

    document.getElementById('state').addEventListener('change', function () {
        const stateId = this.value;

        if (stateId) {
            fetch(`/cities/${stateId}`)
                .then(response => response.json())
                .then(data => {
                    const cityDropdown = document.getElementById('city');
                    cityDropdown.innerHTML = '<option value="">Select City</option>';
                    data.forEach(city => {
                        cityDropdown.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });
                    cityDropdown.disabled = false;
                });
        }
    });
</script>
@endsection
