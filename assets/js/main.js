$(function() {
    $("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        enablePagination: false,
        transitionEffectSpeed: 500,
        labels: {
            current: ""
        }
    });

    // profile
    $(".profile").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("name", $("input[name = 'name']").val());
        form_data.append("mobile", $("input[name = 'mobile']").val());
        form_data.append("email", $("input[name = 'email']").val());
        form_data.append("gender", $('select[name="gender"] option:selected').val());
        form_data.append("dob", $("input[name = 'dob']").val());
        form_data.append("image", document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
        $.ajax({
            url: "/supplier/profile",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".profile").html("Loading... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".profile").html("Next").prop("disabled", false);
                profileMsg(data);
            }
        });
    });

    function profileMsg(msg) {
        $(".name_err").text("");
        $(".mobile_err").text("");
        $(".email_err").text("");
        $(".gender_err").text("");
        $(".dob_err").text("");
        $(".image_err").text("");
        if ($.isEmptyObject(msg.error)) {
            console.log(msg.success);
            $(".icon-profile").addClass("validated");
            $("#wizard").steps("next");
        } else {
            $(".icon-profile").removeClass("validated");
            $.each(msg.error, function(key, value) {
                $("." + key + "_err").text(value);
            });
        }
    }

    //kyc
    $(".kyc").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("brand_name", $("input[name = 'brand_name']").val());
        form_data.append("poc_name", $("input[name = 'poc_name']").val());
        form_data.append("poc_mobile", $("input[name = 'poc_mobile']").val());
        form_data.append("gst_number", $("input[name = 'gst_number']").val());
        form_data.append("pan_number", $("input[name = 'pan_number']").val());
        form_data.append("gst_certificate", document.getElementById('gst_certificate').files[0]);
        form_data.append("pan_card", document.getElementById('pan_card').files[0]);

        $.ajax({
            url: "/supplier/kyc",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".kyc").html("Loading... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".kyc").html("Next").prop("disabled", false);
                kycMsg(data);
            }
        });
    });

    function kycMsg(msg) {
        $(".brand_name_err").text("");
        $(".poc_name_err").text("");
        $(".poc_mobile_err").text("");
        $(".gst_number_err").text("");
        $(".pan_number_err").text("");
        $(".gst_certificate_err").text("");
        $(".pan_card_err").text("");
        if ($.isEmptyObject(msg.error)) {
            console.log(msg.success);
            $(".icon-kyc").addClass("validated");
            $("#wizard").steps("next");
        } else {
            $(".icon-kyc").removeClass("validated");
            $.each(msg.error, function(key, value) {
                $("." + key + "_err").text(value);
            });
        }
    }

    //bank
    $(".bank").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("bank_name", $("input[name = 'bank_name']").val());
        form_data.append("acholder_name", $("input[name = 'acholder_name']").val());
        form_data.append("account_number", $("input[name = 'account_number']").val());
        form_data.append("ifsc_code", $("input[name = 'ifsc_code']").val());
        form_data.append("cancelled_cheque", document.getElementById('cancelled_cheque').files[0]);
        $.ajax({
            url: "/supplier/bank",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".bank").html("Loading... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".bank").html("Next").prop("disabled", false);
                bankMsg(data);
            }
        });


    });

    function bankMsg(msg) {
        $(".bank_name_err").text("");
        $(".acholder_name_err").text("");
        $(".account_number_err").text("");
        $(".ifsc_code_err").text("");
        $(".cancelled_cheque_err").text("");
        if ($.isEmptyObject(msg.error)) {
            console.log(msg.success);
            $(".icon-bank").addClass("validated");
            $("#wizard").steps("next");
        } else {
            $(".icon-bank").removeClass("validated");
            $.each(msg.error, function(key, value) {
                $("." + key + "_err").text(value);
            });
        }
    }

    //shipment
    $(".shipment").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("cod", $('select[name="cod"] option:selected').val());
        form_data.append("return_type", $('select[name="return_type"] option:selected').val());
        form_data.append("exchange_type", $('select[name="exchange_type"] option:selected').val());
        form_data.append("sla_min", $('select[name="sla_min"] option:selected').val());
        form_data.append("sla_max", $('select[name="sla_max"] option:selected').val());
        $.ajax({
            url: "/supplier/shipment",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".shipment").html("Loading... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".shipment").html("Next").prop("disabled", false);
                shipmentMsg(data);
            }
        });

    });

    function shipmentMsg(msg) {
        $(".cod_err").text("");
        $(".return_type_err").text("");
        $(".exchange_type_err").text("");
        $(".sla_min_err").text("");
        $(".sla_max_err").text("");
        if ($.isEmptyObject(msg.error)) {
            console.log(msg.success);
            $(".icon-shipment").addClass("validated");
            $("#wizard").steps("next");
        } else {
            $(".icon-shipment").removeClass("validated");
            $.each(msg.error, function(key, value) {
                $("." + key + "_err").text(value);
            });
        }
    }

    //address
    $(".address").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("pickup_address", $("input[name = 'pickup_address']").val());
        form_data.append("pickup_landmark", $("input[name = 'pickup_landmark']").val());
        form_data.append("pickup_pincode", $("input[name = 'pickup_pincode']").val());
        form_data.append("pickup_city", $("input[name = 'pickup_city']").val());
        form_data.append("pickup_state", $("select[name='pickup_state'] option:selected").val());
        form_data.append("pickup_country", $("select[name='pickup_country'] option:selected").val());

        form_data.append("address", $("input[name = 'address']").val());
        form_data.append("landmark", $("input[name = 'landmark']").val());
        form_data.append("pincode", $("input[name = 'pincode']").val());
        form_data.append("city", $("input[name = 'city']").val());
        form_data.append("state", $("select[name='state'] option:selected").val());
        form_data.append("country", $("select[name='country'] option:selected").val());

        $.ajax({
            url: "/supplier/address",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".address").html("Loading... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".address").html("Next").prop("disabled", false);
                addressMsg(data);
            }
        });
    });

    function addressMsg(msg) {
        $(".pickup_address_err").text("");
        $(".pickup_landmark_err").text("");
        $(".pickup_pincode_err").text("");
        $(".pickup_city_err").text("");
        $(".pickup_state_err").text("");
        $(".pickup_country_err").text("");

        $(".address_err").text("");
        $(".landmark_err").text("");
        $(".pincode_err").text("");
        $(".city_err").text("");
        $(".state_err").text("");
        $(".country_err").text("");
        if ($.isEmptyObject(msg.error)) {
            console.log(msg.success);
            $(".icon-address").addClass("validated");
            $("#wizard").steps("next");
        } else {
            $(".icon-address").removeClass("validated");
            $('#address').prop('checked', false);
            clearAddress();
            $.each(msg.error, function(key, value) {
                $("." + key + "_err").text(value);
            });
        }
    }

    //business
    $(".business").click(function() {
        //profile     
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("name", $("input[name = 'name']").val());
        form_data.append("mobile", $("input[name = 'mobile']").val());
        form_data.append("email", $("input[name = 'email']").val());
        form_data.append("gender", $('select[name="gender"] option:selected').val());
        form_data.append("dob", $("input[name = 'dob']").val());
        form_data.append("image", document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');

        //kyc               
        form_data.append("brand_name", $("input[name = 'brand_name']").val());
        form_data.append("poc_name", $("input[name = 'poc_name']").val());
        form_data.append("poc_mobile", $("input[name = 'poc_mobile']").val());
        form_data.append("gst_number", $("input[name = 'gst_number']").val());
        form_data.append("pan_number", $("input[name = 'pan_number']").val());
        form_data.append("gst_certificate", document.getElementById('gst_certificate').files[0]);
        form_data.append("pan_card", document.getElementById('pan_card').files[0]);

        // //bank               
        form_data.append("bank_name", $("input[name = 'bank_name']").val());
        form_data.append("acholder_name", $("input[name = 'acholder_name']").val());
        form_data.append("account_number", $("input[name = 'account_number']").val());
        form_data.append("ifsc_code", $("input[name = 'ifsc_code']").val());
        form_data.append("cancelled_cheque", document.getElementById('cancelled_cheque').files[0]);

        // //shipment                
        form_data.append("cod", $('select[name="cod"] option:selected').val());
        form_data.append("return_type", $('select[name="return_type"] option:selected').val());
        form_data.append("exchange_type", $('select[name="exchange_type"] option:selected').val());
        form_data.append("sla_min", $('select[name="sla_min"] option:selected').val());
        form_data.append("sla_max", $('select[name="sla_max"] option:selected').val());

        //address 
        form_data.append("pickup_address", $("input[name = 'pickup_address']").val());
        form_data.append("pickup_landmark", $("input[name = 'pickup_landmark']").val());
        form_data.append("pickup_pincode", $("input[name = 'pickup_pincode']").val());
        form_data.append("pickup_city", $("input[name = 'pickup_city']").val());
        form_data.append("pickup_state", $("select[name='pickup_state'] option:selected").val());
        form_data.append("pickup_country", $("select[name='pickup_country'] option:selected").val());

        form_data.append("address", $("input[name = 'address']").val());
        form_data.append("landmark", $("input[name = 'landmark']").val());
        form_data.append("pincode", $("input[name = 'pincode']").val());
        form_data.append("city", $("input[name = 'city']").val());
        form_data.append("state", $("select[name='state'] option:selected").val());
        form_data.append("country", $("select[name='country'] option:selected").val());

        // //business        
        form_data.append("aggregator", $("select[name='aggregator'] option:selected").val());
        form_data.append("aggregator_commission", $("select[name='aggregator_commission'] option:selected").val());
        form_data.append("plan_id", $("select[name='plan_id'] option:selected").val());
        form_data.append("order_guarantee", $("input[name = 'order_guarantee']").val());
        form_data.append("replica_supplier", $("select[name='replica_supplier'] option:selected").val());
        form_data.append("supplier_type", $("select[name='supplier_type'] option:selected").val());
        form_data.append("primary_category", $("select[name='primary_category'] option:selected").val());
        form_data.append("secondary_category", $("select[name='secondary_category'] option:selected").val());

        $.ajax({
            url: "/supplier/business",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".business").html("Saving... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".business").html("Submit Details").prop("disabled", false);
                if (data.failed) {
                    Swal.fire({
                        type: "error",
                        title: "Oops...",
                        text: "Something went wrong! Please try again!",
                        confirmButtonClass: "btn btn-confirm mt-2",
                    });
                    profileMsg(data);
                    kycMsg(data);
                    bankMsg(data);
                    shipmentMsg(data);
                    addressMsg(data);
                    businessMsg(data);
                } else if (data.error) {
                    Swal.fire({
                        type: "error",
                        title: "Oops...",
                        text: "Please fill are required feilds!",
                        confirmButtonClass: "btn btn-confirm mt-2",
                    });
                    profileMsg(data);
                    kycMsg(data);
                    bankMsg(data);
                    shipmentMsg(data);
                    addressMsg(data);
                    businessMsg(data);
                } else {
                    window.location = "/supplier";
                }
            }
        });

        function businessMsg(msg) {
            $(".aggregator_err").text("");
            $(".aggregator_commission_err").text("");
            $(".plan_id_err").text("");
            $(".order_guarantee_err").text("");
            $(".replica_supplier_err").text("");
            $(".supplier_type_err").text("");
            $(".primary_category_err").text("");
            $(".secondary_category_err").text("");

            if ($.isEmptyObject(msg.error)) {
                $(".icon-business").addClass("validated");
            } else {
                $.each(msg.error, function(key, value) {
                    $("." + key + "_err").text(value);
                });
            }
        }
    })

    //update profile
    $(".update-profile").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("hid", $("input[name = 'hid']").val());
        form_data.append("name", $("input[name = 'name']").val());
        form_data.append("mobile", $("input[name = 'mobile']").val());
        form_data.append("email", $("input[name = 'email']").val());
        form_data.append("gender", $('select[name="gender"] option:selected').val());
        form_data.append("dob", $("input[name = 'dob']").val());
        form_data.append("image", document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
        $.ajax({
            url: "/supplier/updateProfile",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".update-profile").html("Updating... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".update-profile").html("Update").prop("disabled", false);
                $(".name_err").text("");
                $(".mobile_err").text("");
                $(".email_err").text("");
                $(".gender_err").text("");
                $(".dob_err").text("");
                $(".image_err").text("");
                if (data.failed) {
                    Swal.fire({
                        title: "Something went wrong please try again!",
                        text: "",
                        type: "error",
                    })
                } else if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        title: "Profile has been updated.",
                        text: "",
                        type: "success",
                    })
                } else {
                    $.each(data.error, function(key, value) {
                        $("." + key + "_err").text(value);
                    });
                }
            }
        });
    });


    //update kyc
    $(".update-kyc").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("hid", $("input[name = 'hid']").val());
        form_data.append("brand_name", $("input[name = 'brand_name']").val());
        form_data.append("poc_name", $("input[name = 'poc_name']").val());
        form_data.append("poc_mobile", $("input[name = 'poc_mobile']").val());
        form_data.append("pan_number", $("input[name = 'pan_number']").val());
        form_data.append("gst_number", $("input[name = 'gst_number']").val());
        form_data.append("pan_card", document.getElementById('pan_card').files[0] ? document.getElementById('pan_card').files[0] : '');
        form_data.append("gst_certificate", document.getElementById('gst_certificate').files[0] ? document.getElementById('gst_certificate').files[0] : '');
        $.ajax({
            url: "/supplier/updateKyc",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".update-kyc").html("Updating... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".update-kyc").html("Update").prop("disabled", false);
                $(".brand_name_err").text("");
                $(".poc_name_err").text("");
                $(".poc_mobile_err").text("");
                $(".pan_number_err").text("");
                $(".gst_number_err").text("");
                $(".pan_card_err").text("");
                $(".gst_certificate_err").text("");
                if (data.failed) {
                    Swal.fire({
                        title: "Something went wrong please try again!",
                        text: "",
                        type: "error",
                    })
                } else if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        title: "KYC has been updated.",
                        text: "",
                        type: "success",
                    })
                } else {
                    $.each(data.error, function(key, value) {
                        $("." + key + "_err").text(value);
                    });
                }
            }
        });
    });

    //update bank
    $(".update-bank").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("hid", $("input[name = 'hid']").val());
        form_data.append("bank_name", $("input[name = 'bank_name']").val());
        form_data.append("acholder_name", $("input[name = 'acholder_name']").val());
        form_data.append("account_number", $("input[name = 'account_number']").val());
        form_data.append("ifsc_code", $("input[name = 'ifsc_code']").val());
        form_data.append("cancelled_cheque", document.getElementById('cancelled_cheque').files[0] ? document.getElementById('cancelled_cheque').files[0] : '');
        $.ajax({
            url: "/supplier/updateBank",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".update-bank").html("Updating... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".update-bank").html("Update").prop("disabled", false);
                $(".bank_name_err").text("");
                $(".acholder_name_err").text("");
                $(".account_number_err").text("");
                $(".ifsc_code_err").text("");
                $(".cancelled_cheque_err").text("");
                if (data.failed) {
                    Swal.fire({
                        title: "Something went wrong please try again!",
                        text: "",
                        type: "error",
                    })
                } else if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        title: "Bank details has been updated.",
                        text: "",
                        type: "success",
                    })
                } else {
                    $.each(data.error, function(key, value) {
                        $("." + key + "_err").text(value);
                    });
                }
            }
        });
    });


    //update shipment
    $(".update-shipment").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("hid", $("input[name = 'hid']").val());
        form_data.append("cod", $('select[name="cod"] option:selected').val());
        form_data.append("return_type", $('select[name="return_type"] option:selected').val());
        form_data.append("exchange_type", $('select[name="exchange_type"] option:selected').val());
        form_data.append("sla_min", $('select[name="sla_min"] option:selected').val());
        form_data.append("sla_max", $('select[name="sla_max"] option:selected').val());
        $.ajax({
            url: "/supplier/updateShipment",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".update-shipment").html("Updating... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".update-shipment").html("Update").prop("disabled", false);
                $(".cod_err").text("");
                $(".sla_min_err").text("");
                $(".sla_max_err").text("");
                $(".return_type_err").text("");
                $(".exchange_type_err").text("");
                if (data.failed) {
                    Swal.fire({
                        title: "Something went wrong please try again!",
                        text: "",
                        type: "error",
                    })
                } else if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        title: "Shipment details has been updated.",
                        text: "",
                        type: "success",
                    })
                } else {
                    $.each(data.error, function(key, value) {
                        $("." + key + "_err").text(value);
                    });
                }
            }
        });
    });

    //update address
    $(".update-address").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("hid", $("input[name = 'hid']").val());
        form_data.append("pickup_address", $("input[name = 'pickup_address']").val());
        form_data.append("pickup_landmark", $("input[name = 'pickup_landmark']").val());
        form_data.append("pickup_pincode", $("input[name = 'pickup_pincode']").val());
        form_data.append("pickup_city", $("input[name = 'pickup_city']").val());
        form_data.append("pickup_state", $("select[name='pickup_state'] option:selected").val());

        form_data.append("address", $("input[name = 'address']").val());
        form_data.append("landmark", $("input[name = 'landmark']").val());
        form_data.append("pincode", $("input[name = 'pincode']").val());
        form_data.append("city", $("input[name = 'city']").val());
        form_data.append("state", $("select[name='state'] option:selected").val());

        $.ajax({
            url: "/supplier/updateAddress",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".update-address").html("Updating... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".update-address").html("Update").prop("disabled", false);
                $(".pickup_address_err").text("");
                $(".pickup_landmark_err").text("");
                $(".pickup_pincode_err").text("");
                $(".pickup_city_err").text("");
                $(".pickup_state_err").text("");

                $(".address_err").text("");
                $(".landmark_err").text("");
                $(".pincode_err").text("");
                $(".city_err").text("");
                $(".state_err").text("");

                if (data.failed) {
                    Swal.fire({
                        title: "Something went wrong please try again!",
                        text: "",
                        type: "error",
                    })
                } else if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        title: "Address has been updated.",
                        text: "",
                        type: "success",
                    })
                } else {
                    $.each(data.error, function(key, value) {
                        $("." + key + "_err").text(value);
                    });
                }
            }
        });
    });


    //update business
    $(".update-business").click(function() {
        var form_data = new FormData();
        form_data.append("_token", $("input[name = '_token']").val());
        form_data.append("hid", $("input[name = 'hid']").val());
        form_data.append("aggregator", $("select[name='aggregator'] option:selected").val());
        form_data.append("aggregator_commission", $("select[name='aggregator_commission'] option:selected").val());
        form_data.append("plan_id", $("select[name='plan_id'] option:selected").val());
        form_data.append("order_guarantee", $("input[name = 'order_guarantee']").val());
        form_data.append("replica_supplier", $("select[name='replica_supplier'] option:selected").val());
        form_data.append("supplier_type", $("select[name='supplier_type'] option:selected").val());
        form_data.append("primary_category", $("select[name='primary_category'] option:selected").val());
        form_data.append("secondary_category", $("select[name='secondary_category'] option:selected").val());

        $.ajax({
            url: "/supplier/updateBusiness",
            type: "POST",
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function() {
                $(".update-business").html("Updating... <span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").prop("disabled", true);
            },
            success: function(data) {
                $(".update-business").html("Update").prop("disabled", false);
                $(".aggregator_err").text("");
                $(".aggregator_commission_err").text("");
                $(".plan_id_err").text("");
                $(".order_guarantee_err").text("");
                $(".replica_supplier_err").text("");
                $(".supplier_type_err").text("");
                $(".primary_category_err").text("");
                $(".secondary_category_err").text("");

                if (data.failed) {
                    Swal.fire({
                        title: "Something went wrong please try again!",
                        text: "",
                        type: "error",
                    })
                } else if ($.isEmptyObject(data.error)) {
                    Swal.fire({
                        title: "Business details has been updated.",
                        text: "",
                        type: "success",
                    })
                } else {
                    $.each(data.error, function(key, value) {
                        $("." + key + "_err").text(value);
                    });
                }
            }
        });
    });

    $("#address").click(function() {
        if ($("input[name = 'pickup_address']").val() == "" ||
            $("input[name = 'pickup_landmark']").val() == "" ||
            $("input[name = 'pickup_pincode']").val() == "" ||
            $("input[name = 'pickup_city']").val() == "" ||
            $("select[name='pickup_state'] option:selected").val() == "") {
            Swal.fire({
                type: "error",
                title: "Oops...",
                text: "Please fill all pickup address!",
                confirmButtonClass: "btn btn-confirm mt-2",
            });
            return false;
        }
        if ($(this).is(":checked")) {
            $("input[name = 'address']").val($("input[name = 'pickup_address']").val()).prop('disabled', true);
            $("input[name = 'landmark']").val($("input[name = 'pickup_landmark']").val()).prop('disabled', true);
            $("input[name = 'pincode']").val($("input[name = 'pickup_pincode']").val()).prop('disabled', true);
            $("input[name = 'city']").val($("input[name = 'pickup_city']").val()).prop('disabled', true);
            $("select[name= 'state']").val($("select[name='pickup_state'] option:selected").val()).prop('disabled', true);
            $("select[name= 'country']").val(1).prop('disabled', true);

            $("input[name = 'pickup_address']").prop("disabled", true);
            $("input[name = 'pickup_landmark']").prop("disabled", true);
            $("input[name = 'pickup_pincode']").prop("disabled", true);
            $("input[name = 'pickup_city']").prop("disabled", true);
            $("select[name= 'pickup_state']").prop("disabled", true);
            $("select[name= 'pickup_country']").prop("disabled", true);
        } else {
            $("input[name = 'pickup_address']").prop("disabled", false);
            $("input[name = 'pickup_landmark']").prop("disabled", false);
            $("input[name = 'pickup_pincode']").prop("disabled", false);
            $("input[name = 'pickup_city']").prop("disabled", false);
            $("select[name= 'pickup_state']").prop("disabled", false);
            $("select[name= 'pickup_country']").prop("disabled", false);
            clearAddress();
        }
    });

    function clearAddress() {
        $("input[name = 'address']").val("").prop('disabled', false);
        $("input[name = 'landmark']").val("").prop('disabled', false);
        $("input[name = 'pincode']").val("").prop('disabled', false);
        $("input[name = 'city']").val("").prop('disabled', false);
        $("select[name='state']").val("").prop('disabled', false);
        $("select[name='country']").val(1).prop('disabled', false);
    }


    // Select Dropdown
    $('html').click(function() {
        $('.select .dropdown').hide();
    });
    $('.select').click(function(event) {
        event.stopPropagation();
    });
    $('.select .select-control').click(function() {
        $(this).parent().next().toggle();
    })
    $('.select .dropdown li').click(function() {
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    })
})