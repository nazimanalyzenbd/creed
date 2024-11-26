@extends('layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Admin User</h4>
                    </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ route('users.update', $adminUser->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" id="id" value="{{$adminUser->id}}">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" id="name" value="{{$adminUser->name}}" class="form-control" placeholder="" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" id="email" value="{{$adminUser->email}}" class="form-control" placeholder="" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Phone Number<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone_number" id="phone_number" value="{{$adminUser->phone_number}}" class="form-control" placeholder="" required>
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control" placeholder="">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Address<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="form-row">
                                                <div class="col-sm-4">
                                                    <input type="text" name="address" id="address" value="{{$adminUser->address}}" class="form-control" placeholder="Address" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select id="country" name="country" class="form-control select2" required>
                                                        <option>Select Country..</option>
                                                        @foreach($country as $list)
                                                            <option value="{{$list->id}}" {{$adminUser->country==$list->id?'selected':''}}>{{$list->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select id="state" name="state" class="form-control select2">
                                                        <!-- <option value="">Select State</option> -->
                                                    </select>
                                                </div>
                                                <div class="col mt-2 mt-sm-0">
                                                    <select id="city" name="city" class="form-control select2">
                                                        <!-- <option value="">Select City</option> -->
                                                       
                                                    </select>
                                                </div>
                                                <div class="col mt-2 mt-sm-0">
                                                    <input type="text" name="zip_code" id="zip_code" value="{{$adminUser->zip_code}}" class="form-control" placeholder="Zip Code" required>
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
                                            <button type="submit" class="btn btn-primary">Update</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Get stored values
        const selectedCountry = "{{ $adminUser->country }}";
        const selectedState = "{{ $adminUser->state }}";
        const selectedCity = "{{ $adminUser->city }}";

        // Load states based on the selected country
        if (selectedCountry) {
            $.ajax({
                url: `/states/${selectedCountry}`,
                type: 'GET',
                success: function (states) {
                    let stateOptions = '<option value="">Select State</option>';
                    $.each(states, function (key, state) {
                        stateOptions += `<option value="${state.id}" ${state.id == selectedState ? 'selected' : ''}>${state.name}</option>`;
                    });
                    $('#state').html(stateOptions);

                    // Load cities based on the selected state
                    if (selectedState) {
                        $.ajax({
                            url: `/cities/${selectedState}`,
                            type: 'GET',
                            success: function (cities) {
                                let cityOptions = '<option value="">Select City</option>';
                                $.each(cities, function (key, city) {
                                    cityOptions += `<option value="${city.id}" ${city.id == selectedCity ? 'selected' : ''}>${city.name}</option>`;
                                });
                                $('#city').html(cityOptions);
                            }
                        });
                    }
                }
            });
        }

        // Update states when country is changed
        $('#country').change(function () {
            const countryId = $(this).val();
            $('#state').html('<option value="">Select State</option>');
            $('#city').html('<option value="">Select City</option>');

            if (countryId) {
                $.ajax({
                    url: `/states/${countryId}`,
                    type: 'GET',
                    success: function (states) {
                        let stateOptions = '<option value="">Select State</option>';
                        $.each(states, function (key, state) {
                            stateOptions += `<option value="${state.id}">${state.name}</option>`;
                        });
                        $('#state').html(stateOptions);
                    }
                });
            } else {
                $('#state').html('<option value="">Select State</option>');
            }
        });

        // Update cities when state is changed
        $('#state').change(function () {
            const stateId = $(this).val();
            $('#city').html('<option value="">Loading...</option>');

            if (stateId) {
                $.ajax({
                    url: `/cities/${stateId}`,
                    type: 'GET',
                    success: function (cities) {
                        let cityOptions = '<option value="">Select City</option>';
                        $.each(cities, function (key, city) {
                            cityOptions += `<option value="${city.id}">${city.name}</option>`;
                        });
                        $('#city').html(cityOptions);
                    }
                });
            } else {
                $('#city').html('<option value="">Select City</option>');
            }
        });
    });
</script>

@endsection
