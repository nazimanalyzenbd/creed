@extends('layouts.app')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Statistics</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Widget</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Statistics</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-white">Power</h5>
                                        <span class="text-white">2017.1.20</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="text-white"><i class="fa fa-caret-up"></i> 260</h5>
                                        <span class="text-white">+12.5(2.8%)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h5>3650</h5>
                                        <span>VIEWS OF YOUR PROJECT</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="card bg-primary">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-white">Power</h5>
                                        <span class="text-white">2017.1.20</span>
                                    </div>
                                    <div class="col text-right">
                                        <h5 class="text-white"><i class="fa fa-caret-up"></i> 260</h5>
                                        <span class="text-white">+12.5(2.8%)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="chart_widget_5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>Latency</h5>
                            </div>
                            <div class="chart-wrapper">
                                <div id="chart_widget_17"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-xxl-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h4 class="text-uppercase">74,206 K</h4>
                                                <span>Lifetime earnings</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="chart-wrapper" style="height: 100px">
                                                    <canvas id="chart_widget_7"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <h5>Lorem Ipsum</h5>
                                            </div>
                                            <div class="col-auto">
                                                <h5>
                                                    <span><i class="fa fa-caret-up"></i></span>
                                                    <span>2,250</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="chart_widget_6"></div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h5 class="font-weight-normal">1230</h5>
                                                <span>Type A</span>
                                            </div>
                                            <div class="col text-center">
                                                <h5 class="font-weight-normal">1230</h5>
                                                <span>Type A</span>
                                            </div>
                                            <div class="col text-center">
                                                <h5 class="font-weight-normal">1230</h5>
                                                <span>Type A</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <h5>Lorem Ipsum</h5>
                                            </div>
                                            <div class="col-auto">
                                                <h5>
                                                    <span><i class="fa fa-caret-up"></i></span>
                                                    <span>2,250</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="chart_widget_3"></canvas>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col text-center">
                                                <h5 class="font-weight-normal">1230</h5>
                                                <span>Type A</span>
                                            </div>
                                            <div class="col text-center">
                                                <h5 class="font-weight-normal">1230</h5>
                                                <span>Type A</span>
                                            </div>
                                            <div class="col text-center">
                                                <h5 class="font-weight-normal">1230</h5>
                                                <span>Type A</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h4 class="card-title text-uppercase font-weight-normal">Market Now</h4>
                                <h2 class="font-weight-normal text-danger">
                                    <span><i class="fa fa-caret-up"></i></span>
                                    <span>3454664</span>
                                </h2>
                                <div class="row mt-5">
                                    <div class="col text-center">
                                        <h5 class="font-weight-normal">APPL</h5>
                                        <span class="text-success">+ 82.24 %</span>
                                    </div>
                                    <div class="col text-center">
                                        <h5 class="font-weight-normal">FB</h5>
                                        <span class="text-danger">- 12.24 %</span>
                                    </div>
                                    <div class="col text-center">
                                        <h5 class="font-weight-normal">GOOG</h5>
                                        <span class="text-success">+ 42.24 %</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h4 class="card-title text-uppercase font-weight-normal">Sales Analysis</h4>
                                <h2 class="font-weight-normal text-danger">
                                    <span><i class="fa fa-caret-up"></i></span>
                                    <span>3454664</span>
                                </h2>
                                <div class="row mt-5">
                                    <div class="col text-center">
                                        <h5 class="font-weight-normal">Today</h5>
                                        <span class="text-success">+ 8224</span>
                                    </div>
                                    <div class="col text-center">
                                        <h5 class="font-weight-normal">Today</h5>
                                        <span class="text-danger">- 1224</span>
                                    </div>
                                    <div class="col text-center">
                                        <h5 class="font-weight-normal">Week</h5>
                                        <span class="text-success">+ 4224</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="chart_widget_8"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h4 class="card-title text-uppercase font-weight-normal">Top Products</h4>
                                <ul class="mt-5">
                                    <li class="border-bottom py-3">
                                        <div class="media">
                                            
                                            <div class="media-body d-flex justify-content-between align-items-center ml-3">
                                                <div>
                                                    <h6>Mawbeef Halal Beef Burger</h6>
                                                    <p class="m-0">Beef Burger</p>
                                                </div>
                                                <div>
                                                    <h6>+$17</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="border-bottom py-3">
                                        <div class="media">
                                            
                                            <div class="media-body d-flex justify-content-between align-items-center ml-3">
                                                <div>
                                                    <h6>Hamburger</h6>
                                                    <p class="m-0">A six pack Burger</p>
                                                </div>
                                                <div>
                                                    <h6>+$300</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3">
                                        <div class="media">
                                            
                                            <div class="media-body d-flex justify-content-between align-items-center ml-3">
                                                <div>
                                                    <h6>Vegitable Burger</h6>
                                                    <p class="m-0">Burger Veggie</p>
                                                </div>
                                                <div>
                                                    <h6>+$300</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_9"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h4 class="card-title text-uppercase font-weight-normal">Top Products</h4>
                                <ul class="mt-5">
                                    <li class="border-bottom py-3">
                                        <div class="media">
                                            
                                            <div class="media-body d-flex justify-content-between align-items-center ml-3">
                                                <div>
                                                    <h6>Mawbeef Halal Beef Burger</h6>
                                                    <p class="m-0">Beef Burger</p>
                                                </div>
                                                <div>
                                                    <h6>+$17</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="border-bottom py-3">
                                        <div class="media">
                                            
                                            <div class="media-body d-flex justify-content-between align-items-center ml-3">
                                                <div>
                                                    <h6>Hamburger</h6>
                                                    <p class="m-0">A six pack Burger</p>
                                                </div>
                                                <div>
                                                    <h6>+$300</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3">
                                        <div class="media">
                                            
                                            <div class="media-body d-flex justify-content-between align-items-center ml-3">
                                                <div>
                                                    <h6>Vegitable Burger</h6>
                                                    <p class="m-0">Burger Veggie</p>
                                                </div>
                                                <div>
                                                    <h6>+$300</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_10"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-8 col-lg-6">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-5 p-0">
                                    <div class="card-body">
                                        <h6 class="font-weight-normal text-uppercase">Weekly sales</h6>
                                        <h4>$ 14000</h4>
                                        <div>
                                            <span class="badge badge-light">60%</span>
                                            <span>Higher</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7 p-0">
                                    <div class="chart-wrapper">
                                        <canvas id="chart_widget_11"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>570</h5>
                                        <p>All Sales</p>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="chart_widget_14"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>570</h5>
                                        <p>All Sales</p>
                                    </div>
                                    <div class="chart-wrapper">
                                        <canvas id="chart_widget_15"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-4 col-lg-6">
                        <div class="card">
                            <div class="chart-wrapper">
                                <canvas id="chart_widget_16"></canvas>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Sales Status</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <h6>67%</h6>
                                            <span>Grow</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="d-flex justify-content-between">
                                            <h6>67%</h6>
                                            <span>Grow</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: 70%"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="d-flex justify-content-between">
                                            <h6>67%</h6>
                                            <span>Grow</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" style="width: 40%"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="d-flex justify-content-between">
                                            <h6>67%</h6>
                                            <span>Grow</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" style="width: 80%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection