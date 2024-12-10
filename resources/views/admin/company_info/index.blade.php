@extends('layouts.app')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Company Information</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" method="post" action="{{route('company-info.store')}}" id="step-form-horizontal" class="step-form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <h4>Personal Info</h4>
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Owner Name<span class="requiredStar">*</span></label>
                                                        <input type="text" name="owner_name" class="form-control" value="{{$tCompanyInfo->owner_name ?? ''}}" placeholder="" required>
                                                        @error('owner_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Email<span class="requiredStar">*</span></label>
                                                        <input type="email" name="email" class="form-control" value="{{$tCompanyInfo->email ?? ''}}" placeholder="" required>
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Phone Number<span class="requiredStar">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{$tCompanyInfo->phone_number ?? ''}}" placeholder="" required>
                                                            <span class="mb-12 col-md-12 badge bg-info" id="mobileValidation" style="text-align: left;"></span>
                                                            @error('phone_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Business Identification Number</label>
                                                        <input type="text" name="business_identification_no" id="business_identification_no" value="{{$tCompanyInfo->business_identification_no ?? ''}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Address</label>
                                                        <textarea name="address" id="address" value="{{$tCompanyInfo->address ?? ''}}" class="form-control">{{$tCompanyInfo->address ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Country</label>
                                                        <select name="country_id" id="country" class="form-control select2">
                                                            <option>Select Country..</option>
                                                            @foreach($country as $list)
                                                                <option value="{{$list->id}}" {{$tCompanyInfo->country??''==$list->id?'selected':''}}>{{$list->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">State</label>
                                                        <select id="state" name="state_id" class="form-control select2">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">City</label>
                                                        <select id="city" name="city_id" class="form-control select2">
                                                            <option value="">Select City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Zip Code</label>
                                                        <input type="number" name="zip_code" id="zip_code" value="{{$tCompanyInfo->zip_code ?? ''}}" class="form-control" placeholder="Zip Code">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <h4>Company Info</h4>
                                        <section>
                                            <div class="row">
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Company Name<span class="requiredStar">*</span></label>
                                                        <input type="text" name="system_name" id="system_name" value="{{$tCompanyInfo->system_name ?? ''}}" class="form-control" placeholder="Creed" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Company Logo<span class="requiredStar">*</span></label>
                                                        <!-- Image Preview -->
                                                        @if($tCompanyInfo)
                                                        <div class="mb-3">
                                                            <img src="{{ asset('images/companyInfo/' . $tCompanyInfo->logo) }}" 
                                                                alt="Company Logo" 
                                                                class="img-fluid rounded" 
                                                                style="max-width: 100%; height: auto; display: block; border: 1px solid #ddd; padding: 5px;">
                                                        </div>
                                                        @endif
                                                        <!-- File Upload Input -->
                                                        <input type="file" name="logo" id="logo" value="{{$tCompanyInfo->logo ?? ''}}"
                                                            class="form-control" 
                                                            accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Company Favicon Icon<span class="requiredStar">*</span></label>
                                                        <!-- Image Preview -->
                                                        @if($tCompanyInfo)
                                                        <div class="mb-3">
                                                            <img src="{{ asset('images/companyInfo/' . $tCompanyInfo->favicon_icon ?? '') }}" 
                                                                alt="Company Logo" 
                                                                class="img-fluid rounded" 
                                                                style="max-width: 100%; height: auto; display: block; border: 1px solid #ddd; padding: 5px;">
                                                        </div>
                                                        @endif
                                                        <!-- File Upload Input -->
                                                        <input type="file" name="favicon_icon" id="favicon_icon" value="{{$tCompanyInfo->favicon_icon ?? ''}}"
                                                            class="form-control" 
                                                            accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Website Link</label>
                                                        <input type="text" name="website_link" id="website_link" value="{{$tCompanyInfo->website_link ?? ''}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Facebook ID</label>
                                                        <input type="text" name="facebook_id" id="facebook_id" value="{{$tCompanyInfo->facebook_id ?? ''}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">LinkedIn ID</label>
                                                        <input type="text" name="linkedIn_id" id="linkedIn_id" value="{{$tCompanyInfo->linkedIn_id ?? ''}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">YouTube Link</label>
                                                        <input type="text" name="youtube_link" id="youtube_link" value="{{$tCompanyInfo->youtube_link ?? ''}}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="form-group row">
                                            <div class="col-sm-10 text-center">
                                                <button type="submit" class="btn btn-primary">{{$tCompanyInfo?'Update':'Submit'}}</button>
                                                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Mobile number validation -->
<script>
$(document).ready(function() {
    $("#phone_number").on("input", function() {
        var mobileNumber = $(this).val();

        if (this.validity.valid) {
            $("#mobileValidation").text("");
            $("#submit").attr('disabled',false);
        } else {
            $("#mobileValidation").text("Invalid mobile number.");
            $("#submit").attr('disabled',true);
        }
    });
});
</script>
<script>
    $(document).ready(function () {
        // Get stored values
        const selectedCountry = "{{ $tCompanyInfo->country ??''}}";
        const selectedState = "{{ $tCompanyInfo->state ??''}}";
        const selectedCity = "{{ $tCompanyInfo->city ??''}}";

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