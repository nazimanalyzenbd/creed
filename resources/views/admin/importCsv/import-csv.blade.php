@extends('layouts.app')
@push('style')
<style>
    td {
        word-wrap: break-word;
        white-space: pre-wrap;
    }
</style>
@endpush
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Import CSV</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <p>{{ session('success') }}</p>
                        @endif

                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form action="{{ route('csv.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="csv_file">Select Table:</label>
                            <select name="table_name" class="form-control mb-4">
                                <option value="">Select one..</option>
                                <option value="country">Country</option>
                                <option value="state">State</option>
                                <option value="city">City</option>
                            </select>
                            <label for="csv_file">Choose CSV file:</label>
                            <input type="file" name="csv_file" id="csv_file" required>
                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Country States Cities List(with Id)</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px;color:black">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Country Name</th>
                                        <th class="text-center">State</th>
                                        <th class="text-center">Cities</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($countryList as $key=>$value)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$value->country_name ?? ''}}({{$value->country_id ?? ''}})</td>
                                            <td>
                                                {{$value->name ?? ''}}({{$value->id ?? ''}})
                                            </td>
                                            <td>
                                                @foreach($value->cities as $value2)
                                                    {{$value2->name ?? ''}}({{$value2->id ?? ''}}){{ $loop->last ? '.' : ', ' }}
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
