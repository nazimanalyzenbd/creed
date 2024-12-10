@extends('layouts.app')

@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Subscription Plan List</h4>
                                <a class="btn btn-info" href="{{route('subscription-plan.create')}}">Add</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px;color:black">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Plan Name</th>
                                                <th>Country</th>
                                                <th>Monthly Cost($)</th>
                                                <th>Discount(%)</th>
                                                <th>Yearly Cost($)</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datas as $key=>$value)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$value->plan_name}}</td>
                                                    <td>{{$value->country->name}}</td>
                                                    <td>{{$value->monthly_cost}}</td>
                                                    <td>{{$value->discount}}</td>
                                                    <td>{{$value->yearly_cost}}</td>
                                                    <td>@if($value->status==1)<span>Active</span>@else<span>Inactive</span>@endif</td>
                                                    <td>
                                                        <a href="{{route('subscription-plan.edit', $value->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                        <form action="{{ route('subscription-plan.destroy', $value->id) }}" method="POST" style="display: inline-block;">
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
