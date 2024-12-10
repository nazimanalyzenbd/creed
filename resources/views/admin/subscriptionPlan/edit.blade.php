@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Subscription Plan</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="text-black" method="POST" action="{{route('subscription-plan.update', $data->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name<span class="requiredStar">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="plan_name" id="plan_name" value="{{$data->plan_name}}" class="form-control" placeholder="" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Select Country<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="country_id" id="single-select">
                                                <option value="">Select one..</option>
                                                @foreach($country as $value)
                                                    <option value="{{$value->id}}" {{$data->country_id==$value->id?'selected':''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Monthly Cost ($)<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="number" name="monthly_cost" id="monthly_cost" value="{{$data->monthly_cost}}" step="0.01" class="form-control" placeholder="" required>
                                            @error('monthly_cost')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Discount (%)</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="discount" id="discount" value="{{$data->discount}}" min="0" class="form-control" placeholder="">
                                            @error('discount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Yearly Cost ($)<span class="requiredStar">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="number" name="yearly_cost" id="yearly_cost" value="{{$data->yearly_cost}}" step="0.01" class="form-control" placeholder="" required>
                                            @error('yearly_cost')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" value="{{$data->description}}" class="form-control">{{$data->description}}</textarea>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">Status</div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $data->status ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        Active/Inactive
                                                    </label>
                                                </div>
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
@endsection
@push('script')
<!-- calculate yearly cost from monthly and discount amount -->
<script>
    $(document).ready(function () {
        function calculateYearlyCost() {
         
            let monthlyCost = parseFloat($('#monthly_cost').val()) || 0;
            let discount = parseFloat($('#discount').val()) || 0;

            let yearlyCost = monthlyCost * 12;

            yearlyCost -= yearlyCost * (discount / 100);

            $('#yearly_cost').val(yearlyCost.toFixed(2));
        }

        $('#monthly_cost, #discount').on('input', calculateYearlyCost);
    });

</script>
@endpush