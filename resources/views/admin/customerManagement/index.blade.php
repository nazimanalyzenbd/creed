@extends('layouts.app')

@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Customer List</h4>
                                <!-- <a class="btn btn-info" href="{{route('creed-tags.create')}}">Add</a> -->
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 mx-auto">
                                            <div class="card text-center">
                                                <select class="form-control" name="customer_type" id="customer_type">
                                                    <option value="">All</option>
                                                    <option value="G">General Account</option>
                                                    <option value="GB">Business Account</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px;color:black">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Customer Type</th>
                                                <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datas as $key=>$value)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$value->first_name .' '. $value->last_name}}</td>
                                                    <td>{{$value->phone_number}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td>@if($value->account_type=="G")
                                                           <span class="badge badge-warning"> General </span>
                                                        @else
                                                            <span class="badge badge-info"> Business </span>
                                                        @endif
                                                    </td>
                                                    <!-- <td>@if($value->status==1)<span>Active</span>@else<span>Inactive</span>@endif</td> -->
                                                    <td>
                                                        <a href="{{route('customers-list.edit', $value->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                        <form action="{{ route('customers-list.delete', $value->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
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
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#customer_type').on('change', function () {
        const selectedValue = $(this).val();

        $.ajax({
            url: `/customers/list?customer_type=${selectedValue}`,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log(response); // Handle the response
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
</script>

@endpush
