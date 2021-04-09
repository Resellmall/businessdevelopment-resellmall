@extends('layout.theme')
@section('content')
<div class="content-page supplier-add">
  <section class="ctlg-pg">
    <div class="container-fluid">
      <div class="row m-t-20">
        <div class="col-12">
          <div class="page-title-box">
            <h3 class="page-title cnt-od l-h-normal heading-main">EDIT SUPPLIER</h3>
          </div>
        </div>
      </div>
      <div class="card m-t-10">
        <div class="card-body prd-add-form">
          <div class="row">
            <div id="wizard">
              {{ csrf_field() }}
              <input type="hidden" value="{{ $user->id }}" name="hid">
              <!-- SECTION PROFILE -->
              <h4><i data-feather="check-circle" class="icon-dual icon-profile"></i> Profile</h4>
              <section>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Name *</label>
                    <input type="text" name="name" value="{{ $user->name }}" placeholder="Enter supplier name" class="marginbx default-input">
                    <span class="text-danger name_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Mobile *</label>
                    <input type="text" name="mobile" value="{{ $user->mobile }}" placeholder="Enter primary number" class="marginbx default-input">
                    <span class="text-danger mobile_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Email ID *</label>
                    <input type="text" name="email" value="{{ $user->email }}" placeholder="Enter email ID" class="marginbx default-input">
                    <span class="text-danger email_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class=" col-lg-4">
                    <label>Gender *</label>
                    <select name="gender">
                      <option value="" selected>Select Gender</option>
                      <option value="1" {{ ($user->gender == '1') ? 'selected' : '' }}>Male</option>
                      <option value="2" {{ ($user->gender == '2') ? 'selected' : '' }}>Female</option>
                    </select>
                    <span class="text-danger gender_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>DOB *</label>
                    <input type="date" name="dob" value="{{ date('Y-m-d', strtotime($user->dob)) }}" placeholder="Date of birth" class="marginbx default-input">
                    <span class="text-danger dob_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>Logo</label>
                    <div class="dpbx">
                      <img class="image" src="{{asset('storage/'.$user->image)}}" alt="your logo">
                      <input type="file" id="image" name="image" class="form-control" onchange="imageURL(this);">
                      <span class="text-danger image_err"></span>
                    </div>
                  </div>
                </div>
                <div class="form-row text-right">
                  <div class="col-lg-2 pull-right">
                    <button class="update-profile btn btn-2-big pull-right">Update</button>
                  </div>
                </div>
              </section>

              <!-- SECTION KYC -->
              <h4><i data-feather="check-circle" class="icon-dual icon-kyc"></i> KYC Details</h4>
              <section>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Brand Name *</label>
                    <input type="text" name="brand_name" value="{{ $supplierDetail->brand_name }}" placeholder="Brand Name" class="marginbx default-input">
                    <span class="text-danger brand_name_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>POC Name *</label>
                    <input type="text" name="poc_name" value="{{ $supplierDetail->poc_name }}" placeholder="POC Name" class="marginbx default-input">
                    <span class="text-danger poc_name_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>POC Mobile *</label>
                    <input type="text" name="poc_mobile" value="{{ $supplierDetail->poc_mobile }}" placeholder="POC Mobile" class="marginbx default-input">
                    <span class="text-danger poc_mobile_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>PAN Card Number *</label>
                    <input type="text" name="pan_number" value="{{ $supplierDetail->pan_number }}" placeholder="ex:29*********z" class="marginbx default-input">
                    <span class="text-danger pan_number_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>PAN Card *</label>
                    <div class="dpbx">
                      <img class="pan" src="{{asset('storage/'.$supplierDetail->pan_card)}}" alt="PAN card">
                      <input type="file" id="pan_card" name="pan_card" class="form-control" onchange="panURL(this);">
                      <span class="text-danger pan_card_err"></span>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>GST Number *</label>
                    <input type="text" name="gst_number" value="{{ $supplierDetail->gst_number }}" placeholder="ex:29*********z" class="marginbx default-input">
                    <span class="text-danger gst_number_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>GST Certificate *</label>
                    <div class="dpbx">
                      <img class="gst" src="{{asset('storage/'.$supplierDetail->gst_certificate)}}" alt="GST Certificate">
                      <input type="file" id="gst_certificate" name="gst_certificate" class="form-control" onchange="gstURL(this);">
                      <span class="text-danger gst_certificate_err"></span>
                    </div>
                  </div>
                </div>
                <div class="form-row text-right">
                  <div class="col-lg-2 pull-right">
                    <button class="update-kyc btn btn-2-big pull-right">update</button>
                  </div>
                </div>
              </section>

              <!-- SECTION BANK -->
              <h4><i data-feather="check-circle" class="icon-dual icon-bank"></i> Bank Details</h4>
              <section>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Bank Name *</label>
                    <input type="text" name="bank_name" value="{{ $supplierDetail->bank_name }}" placeholder="Enter Bank Name" class="marginbx default-input">
                    <span class="text-danger bank_name_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>Account Holders Name *</label>
                    <input type="text" name="acholder_name" value="{{ $supplierDetail->acholder_name }}" placeholder="Enter account holder name" class="marginbx default-input">
                    <span class="text-danger acholder_name_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Account Number *</label>
                    <input type="text" name="account_number" value="{{ $supplierDetail->account_number }}" placeholder="Enter Account number" class="marginbx default-input">
                    <span class="text-danger account_number_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>IFSC Code *</label>
                    <input type="text" name="ifsc_code" value="{{ $supplierDetail->ifsc_code }}" placeholder="Enter IFSC Code" class="marginbx default-input">
                    <span class="text-danger ifsc_code_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Cancelled Cheque *</label>
                    <div class="dpbx">
                      <img class="cheque" src="{{asset('storage/'.$supplierDetail->cancelled_cheque)}}" alt="Cancelled cheque">
                      <input type="file" id="cancelled_cheque" name="cancelled_cheque" class="form-control" onchange="chequeURL(this);">
                      <span class="text-danger cancelled_cheque_err"></span>
                    </div>
                  </div>
                </div>
                <div class="form-row text-right">
                  <div class="col-lg-2 pull-right">
                    <button class="update-bank btn btn-2-big pull-right">Update</button>
                  </div>
                </div>
              </section>

              <!-- SECTION SHIPMENT -->
              <h4><i data-feather="check-circle" class="icon-dual icon-shipment"></i> Shipment Details</h4>
              <section>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>COD Option *</label>
                    <select name="cod">
                      <option value="">Select COD Availability</option>
                      <option value="1" {{ ($supplierDetail->cod == 1) ? 'selected' : '' }}>Available</option>
                      <option value="2" {{ ($supplierDetail->cod == 2) ? 'selected' : '' }}>Not Available</option>
                    </select>
                    <span class="text-danger cod_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>SLA Min *</label>
                    <select name="sla_min">
                      <option value="">Select Service Level Agriment Min</option>
                      <option value="24" {{ ($supplierDetail->sla_min == 24) ? 'selected' : '' }}>24 Hour</option>
                      <option value="48" {{ ($supplierDetail->sla_min == 48) ? 'selected' : '' }}>48 Hour</option>
                      <option value="72" {{ ($supplierDetail->sla_min == 72) ? 'selected' : '' }}>72 Hour</option>
                    </select>
                    <span class="text-danger sla_min_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>SLA Max *</label>
                    <select name="sla_max">
                      <option value="">Select Service Level Agriment Max</option>
                      <option value="24" {{ ($supplierDetail->sla_max == 24) ? 'selected' : '' }}>24 Hour</option>
                      <option value="48" {{ ($supplierDetail->sla_max == 48) ? 'selected' : '' }}>48 Hour</option>
                      <option value="72" {{ ($supplierDetail->sla_max == 72) ? 'selected' : '' }}>72 Hour</option>
                    </select>
                    <span class="text-danger sla_max_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Return type *</label>
                    <select name="return_type">
                      <option value="">Select Type of Return</option>
                      <option value="1" {{ ($supplierDetail->return_type == 1) ? 'selected' : '' }}>Available</option>
                      <option value="2" {{ ($supplierDetail->return_type == 2) ? 'selected' : '' }}>Not Available</option>
                    </select>
                    <span class="text-danger return_type_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Exchange type *</label>
                    <select name="exchange_type">
                      <option value="">Select Type of Exchange</option>
                      <option value="1" {{ ($supplierDetail->exchange_type == 1) ? 'selected' : '' }}>Available</option>
                      <option value="2" {{ ($supplierDetail->exchange_type == 2) ? 'selected' : '' }}>Not Available</option>
                    </select>
                    <span class="text-danger exchange_type_err"></span>
                  </div>
                </div>
                <div class="form-row text-right">
                  <div class="col-lg-2 pull-right">
                    <button class="update-shipment btn btn-2-big pull-right">Update</button>
                  </div>
                </div>
              </section>

              <!-- SECTION ADDRESS -->
              <h4><i data-feather="check-circle" class="icon-dual icon-address"></i> Address Details
              </h4>
              <section>
                <div class="form-row">
                  <div class="col-lg-12">
                    <h5 class="m-0">Pickup Address</h5>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Address *</label>
                    <input type="text" name="pickup_address" value="{{ $pickupAddress->address }}" placeholder="Enter Address" class="marginbx default-input">
                    <span class="text-danger pickup_address_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Landmark *</label>
                    <input type="text" name="pickup_landmark" value="{{ $pickupAddress->landmark }}" placeholder="Enter Landmark" class="marginbx default-input">
                    <span class="text-danger pickup_landmark_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Pincode *</label>
                    <input type="text" name="pickup_pincode" value="{{ $pickupAddress->pincode }}" placeholder="ex:252525" class="marginbx default-input">
                    <span class="text-danger pickup_pincode_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>City *</label>
                    <input type="text" name="pickup_city" value="{{ $pickupAddress->city }}" placeholder="Enter City" class="marginbx default-input">
                    <span class="text-danger pickup_city_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>State *</label>
                    <select name="pickup_state">
                      <option value="">Select State</option>
                      @foreach($states as $state)
                      <option value="{{ $state->id }}" {{($pickupAddress->state_id == $state->id) ? 'selected' : '' }}>{{ $state->state }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger pickup_state_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Country *</label>
                    <select name="pickup_country">
                      <option value="1" selected>India</option>
                    </select>
                    <span class="text-danger pickup_country_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-12">
                    <div class="custom-control custom-checkbox form-check">
                      <input type="checkbox" class="custom-control-input" id="address">
                      <label class="custom-control-label" for="address">Select if Pickup and Registered Address is same</label>
                    </div>
                  </div>
                </div>
                <div class="form-row mt-5">
                  <div class="col-lg-12">
                    <h5 class="m-0">Registered Address</h5>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Address *</label>
                    <input type="text" name="address" value="{{ $userAddress->address }}" placeholder="Enter Address" class="marginbx default-input">
                    <span class="text-danger address_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Landmark *</label>
                    <input type="text" name="landmark" value="{{ $userAddress->landmark }}" placeholder="Enter Landmark" class="marginbx default-input">
                    <span class="text-danger landmark_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Pincode *</label>
                    <input type="text" name="pincode" value="{{ $userAddress->pincode }}" placeholder="ex:252525" class="marginbx default-input">
                    <span class="text-danger pincode_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>City *</label>
                    <input type="text" name="city" value="{{ $userAddress->city }}" placeholder="Enter City" class="marginbx default-input">
                    <span class="text-danger city_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>State *</label>
                    <select name="state">
                      <option value="" selected>Select State</option>
                      @foreach($states as $state)
                      <option value="{{ $state->id }}" {{($userAddress->state_id == $state->id) ? 'selected' : '' }}>{{ $state->state }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger state_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Country *</label>
                    <select name="country">
                      <option value="1" selected>India</option>
                    </select>
                    <span class="text-danger country_err"></span>
                  </div>
                </div>
                <div class="form-row text-right">
                  <div class="col-lg-2 pull-right">
                    <button class="update-address btn btn-2-big pull-right">Update</button>
                  </div>
                </div>
              </section>

              <!-- SECTION BUSINESS -->
              <h4><i data-feather="check-circle" class="icon-dual icon-business"></i> Business Details
              </h4>
              <section>
                <div class="form-row">
                  <div class=" col-lg-4">
                    <label>Aggregator *</label>
                    <select name="aggregator">
                      <option value="">Select</option>
                      <option value="1" {{($supplierDetail->aggregator == 1) ? 'selected' : ''}}>Yes</option>
                      <option value="2" {{($supplierDetail->aggregator == 2) ? 'selected' : ''}}>No</option>
                    </select>
                    <span class="text-danger aggregator_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>Aggregator Commission </label>
                    <select name="aggregator_commission">
                      <option value="">Select commission</option>
                      <option value="5" {{($supplierDetail->aggregator_commission == 5) ? 'selected' : ''}}>5 %</option>
                      <option value="10" {{($supplierDetail->aggregator_commission == 10) ? 'selected' : ''}}>10 %</option>
                    </select>
                    <span class="text-danger aggregator_commission_err"></span>
                  </div>
                  <div class=" col-lg-4">
                    <label>Plan *</label>
                    <select name="plan_id">
                      <option value="" selected>Select Plan</option>
                      @foreach ($supplierPlans as $supplierPlan)
                      <option value="{{ $supplierPlan->id }}" {{ ($supplierPlan->id == $supplierDetail->plan_id) ? 'selected' : '' }}>{{ $supplierPlan->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger plan_id_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-lg-4">
                    <label>Order Guarantee *</label>
                    <input type="text" name="order_guarantee" value="{{ $supplierDetail->order_guarantee }}" placeholder="Enter Order Guarantee" class="marginbx default-input">
                    <span class="text-danger order_guarantee_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Replica Supplier *</label>
                    <select name="replica_supplier">
                      <option value="">Select</option>
                      <option value="1" {{($supplierDetail->replica_supplier == 1) ? 'selected' : '' }}>Yes</option>
                      <option value="2" {{($supplierDetail->replica_supplier == 2) ? 'selected' : '' }}>No</option>
                    </select>
                    <span class="text-danger replica_supplier_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Supplier Type *</label>
                    <select name="supplier_type">
                      <option value="" selected>Select Type</option>
                      @foreach ($supplierTypes as $supplierType )
                      <option value="{{ $supplierType->id }}" {{ ($supplierType->id == $supplierDetail->supplier_type) ? 'selected' : '' }}>{{ $supplierType->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger supplier_type_err"></span>
                  </div>
                </div>
                <div class="form-row">
                  <div class=" col-lg-4">
                    <label>Primary Category *</label>
                    <select name="primary_category" id="primary_category">
                      <option value="" selected>Select Category</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ ($category->id == $supplierDetail->primary_category) ? 'selected' : '' }}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger primary_category_err"></span>
                  </div>
                  <div class="col-lg-4">
                    <label>Secondary Category *</label>
                    <select name="secondary_category" id="secondary_category">
                      <option value="" selected>Select Secondary Category</option>
                      @foreach ($subcategory1s as $subcategory1)
                      <option value="{{ $subcategory1->id }}" {{ ($subcategory1->id == $supplierDetail->secondary_category) ? 'selected' : '' }}>{{ $subcategory1->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger secondary_category_err"></span>
                  </div>
                </div>
                <div class="form-row text-right">
                  <div class="col-lg-2 pull-right">
                    <button class="update-business btn btn-2-big pull-right">Update</button>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <style>
    .validated {
      color: #12ec3e !important;
    }
  </style>
  <script type="text/javascript">
    $(document).on('change', '#primary_category', function() {
      var categoryId = $(this).val();
      $.ajax({
        method: "post",
        url: "{{ route('supplier.subcategory1') }}",
        data: {
          "categoryId": categoryId,
          "_token": "{{ csrf_token() }}",
        },
        beforeSend: function() {
          $('#secondary_category').html('<option value="" selected><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span></option>');
        },
        success: function(response) {
          $('#secondary_category').html(response);
        }
      });
    });

    function imageURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.image').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function panURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.pan').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function gstURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.gst').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    function chequeURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.cheque').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  @endsection()