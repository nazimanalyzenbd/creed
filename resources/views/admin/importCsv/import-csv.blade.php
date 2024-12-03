@extends('layouts.app')
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
            </div>
        </div>
    </div>
</div>
@endsection
