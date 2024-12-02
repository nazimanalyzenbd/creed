@extends('layouts.app')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form step</h4>
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
                                                        <input type="text" name="owner_name" class="form-control" placeholder="" required>
                                                        @error('owner_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Email<span class="requiredStar">*</span></label>
                                                        <input type="email" name="email" class="form-control" placeholder="" required>
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Phone Number<span class="requiredStar">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" required>
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
                                                        <input type="text" name="business_identification_no" id="business_identification_no" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Address</label>
                                                        <textarea name="address" id="address" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Country</label>
                                                        <select name="country" id="country" class="form-control select2">
                                                            <option>Select Country..</option>
                                                            @foreach($country as $list)
                                                                <option value="{{$list->id}}">{{$list->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">State</label>
                                                        <select id="state" name="state" class="form-control select2">
                                                            <option value="">Select State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">City</label>
                                                        <select id="city" name="city" class="form-control select2">
                                                            <option value="">Select City</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Zip Code</label>
                                                        <input type="number" name="zip_code" id="zip_code" class="form-control" placeholder="Zip Code">
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
                                                        <input type="text" name="system_name" id="system_name" class="form-control" placeholder="Creed" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Company Logo<span class="requiredStar">*</span></label>
                                                        <div class="input-group">
                                                            <input type="file" name="logo" id="logo" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Company Favicon Icon<span class="requiredStar">*</span></label>
                                                        <div class="input-group">
                                                            <input type="file" name="favicon_icon" id="favicon_icon" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Website Link</label>
                                                        <input type="text" name="website_link" id="website_link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">Facebook ID</label>
                                                        <input type="text" name="facebook_id" id="facebook_id" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">LinkedIn ID</label>
                                                        <input type="text" name="linkedIn_id" id="linkedIn_id" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <label class="text-label">YouTube Link</label>
                                                        <input type="text" name="youtube_link" id="youtube_link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="form-group row">
                                            <div class="col-sm-10 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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