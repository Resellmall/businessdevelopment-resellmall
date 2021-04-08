@extends('layout.theme')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <form class="form-inline">
                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control border-0" id="dash-daterange" placeholder="Choose Date" />
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-secondary border-secondary text-white">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn main-btn" data-toggle="dropdown" href="#" id="btn"><i data-feather="download-cloud" class="icon-dual"></i> Export</button>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown export-drp">
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <span>EXCEL</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <span>CSV</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <span>PDF</span>
                                    </a>
                                </div>
                            </form>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- end row -->
        </div>
        <!-- container -->
    </div>
    <!-- content -->

    <section class="dash-main">
        <div class="container-fluid">
            <div class="row mt-20">
                <div class="col-lg-3">
                    <div class="dsbx card">
                        <a href="#">
                            <h2>TOTAL SUPPLIERS</h2>
                            <p class="count">{{ $totalSupplier }}</p>
                            <p class="grdw text-success">+{{ $totalSupplierLW }} <i data-feather="arrow-up" class="icon-dual"></i> <span>since last week</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="dsbx card">
                        <a href="#">
                            <h2>ACTIVE SUPPLIERS</h2>
                            <p class="count">{{ $activeSupplier }}</p>
                            <p class="grdw text-success">+{{ $activeSupplierLW }} <i data-feather="arrow-up" class="icon-dual"></i> <span>since last week</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="dsbx card">
                        <a href="#">
                            <h2>INACTIVE SUPPLIERS</h2>
                            <p class="count">{{ $inactiveSupplier }}</p>
                            <p class="grdw text-success">+{{ $inactiveSupplierLW }} <i data-feather="arrow-up" class="icon-dual"></i> <span>since last week</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="dsbx card">
                        <a href="#">
                            <h2>INVENTORY</h2>
                            <p class="count">10,0000</p>
                            <p class="grdw text-success"><i data-feather="arrow-up" class="icon-dual"></i> <span></span></p>
                        </a>
                    </div>
                </div>                
            </div>

        </div>
    </section>
    @endsection()