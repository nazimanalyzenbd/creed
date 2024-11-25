@extends('layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="color-black" method="POST" action="{{route('business-subcategory.update', $data->id)}}" style="color:black">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Category Name<span class="requiredStar">*</span></label>
                                            <div class="col-sm-10">
                                               <select class="form-control select2" name="category_id" id="category_id">
                                                    <option value="">Select one...</option>
                                                    @foreach($categories as $value)
                                                        <option value="{{$value->id}}" {{$data->category_id==$value->id?'selected':''}}>{{$value->name}}</option>
                                                    @endforeach
                                               </select>
                                               @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Sub Category Name<span class="requiredStar">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" id="name" value="{{$data->name}}" class="form-control" placeholder="" required>
                                                @error('name')
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