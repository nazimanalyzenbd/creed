@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Business Type</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="text-black" method="POST" action="{{route('business-type.update', $data->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name<span class="requiredStar">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" id="name" value="{{$data->name}}" class="form-control" placeholder="" required>
                                                @error('name')
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