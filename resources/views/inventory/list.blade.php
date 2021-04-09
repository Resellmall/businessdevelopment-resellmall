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
                                        <input type="text" class="form-control border-0 brd-1" placeholder="Choose Date" id="dash-daterange">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-secondary border-secondary text-white">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <select class="issue-select">
                                    <option selected>Supplier</option>
                                    <option>test@resellmall.com</option>
                                </select>
                                <select class="issue-select">
                                    <option selected>Status</option>
                                    <option>All</option>
                                    <option>In Stock</option>
                                    <option>Out Of Stock</option>
                                    <option>Approved</option>
                                    <option>Rejected</option>
                                </select>
                                <a class="btn main-btn" href="#"><i data-feather="filter" class="icon-dual"></i> Filter</a>


                            </form>
                        </div>
                        <h4 class="page-title cnt-od">Manage Inventory( <span>100000 Products</span>)</h4>
                    </div>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-3">
                    <div class="invbx total">
                        <a href="#">
                            <p>100</p>
                            <h3>Total Products</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invbx instock">
                        <a href="#">
                            <p>100</p>
                            <h3>In Stock Products</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invbx outofstock">
                        <a href="#">
                            <p>100</p>
                            <h3>Out Of Stock Products</h3>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invbx dump">
                        <a href="#">
                            <p>100</p>
                            <h3>Rejected Products</h3>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- end row -->
        </div>
        <!-- container -->
    </div>


    <section class="odrs">
        <div class="container-fluid">
            <div class="row box">
                <div class="col-12">
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-6 text-sm-center form-inline">
                                <div class="form-group mr-2">
                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                        <option value="">Show all</option>
                                        <option value="in stock">In Stock</option>
                                        <option value="out of stock">Out of Stock</option>
                                        <option value="dump">Dump</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" name="keyword" autocomplete="on">
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-danger main-btn" href="#" id="in-stock">In Stock</button>
                                <button class="btn btn-danger main-btn" href="#" id="out-stock">Out of Stock</button>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="demo-foo-filtering" class="table context table-bordered toggle-circle mb-0 odr-tbl">
                            <thead>
                                <tr>
                                    <th data-toggle="false">S.No.</th>
                                    <th>ID</th>
                                    <th>P.Code</th>
                                    <th data-toggle="true">Image</th>
                                    <th data-hide="phone">Details</th>
                                    <th data-hide="phone, tablet">Status</th>
                                    <th data-hide="phone, tablet">Amount</th>
                                    <th data-hide="phone, tablet">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i =0; $i<20; $i++) <tr>
                                    <td>1 <input type="checkbox"></td>
                                    <td><span>35814</span></td>
                                    <td><span>30650</span></td>
                                    <td>
                                        <a href="https://catlog-resellmall-com.s3.amazonaws.com/assets/upload/NgO4Z7L5.jpg" class="image-popup" title="Screenshot-1">
                                            <img src="https://catlog-resellmall-com.s3.amazonaws.com/assets/upload/NgO4Z7L5.jpg" class="img-fluid" alt="work-thumbnail" width="80px">
                                        </a>
                                    </td>
                                    <td class="oddt">
                                        <span>Mens Mesh Black sport shoe</span>
                                        <div class="prd-description">
                                            <p data-toggle="tooltip" data-placement="left" title="" data-original-title="Material: Mesh, Style: Solid Foot Length Size: UK6-25.1cm, UK7-25.8cm, UK8-26.4cm, UK9-27.1cm.">
                                                <strong>Desc</strong> : Material: Mesh, Style: Solid Foot
                                            </p>
                                        </div>
                                        <span><strong>SKU_id</strong> : Arpil 3</span>
                                        <span><strong>Created</strong> : 16-11-2020 07:27</span>
                                    </td>


                                    <td>
                                        <p class="m-0"><a href="#"><span class="badge label-table badge-success">In Stock</span></a></p>
                                        <p class="m-0"><strong>Return Policy </strong> : Available</p>
                                        <p class="m-0"><strong>Exchange </strong> : Not Available</p>
                                    </td>
                                    <td>
                                        <p class="m-0"><strong>SC</strong> : ₹100</p>
                                        <p class="m-0"><strong>SC without TDS</strong> : ₹100</p>
                                        <p class="m-0"><strong>RM Price</strong> : ₹100</p>
                                    </td>
                                    <td>
                                        <p class="m-0"><a href="#"><span class="badge label-table badge-success">View Variant</span></a></p>
                                    </td>
                                    </tr>
                                    @endfor

                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <td colspan="8">
                                        <div class="text-right">
                                            <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </section>
    @endsection()