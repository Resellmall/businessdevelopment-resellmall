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
                        </div>
                        <h3 class="page-title cnt-od l-h-50">SUPPLIER LIST </h3>
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
                    <div class="table-responsive">
                        <table class="table dt-responsive odr-tbl common-tbl table-bordered nowrap w-100 footable data-table">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>EMAIL ID</th>
                                    <th>MOBILE</th>
                                    <th>REGISTERED DATE.</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </section>

    <!-- modal view supplier -->
    <div class="modal fade edodr" id="edit-supp" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog mx-modal-1200" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <h3 class="mod-heading">Supplier Details</h3>
                    <hr>
                    <div class="disp-bx">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('supplier.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',

                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'mobile',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'user_status',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        function destroy(id) {
            if ("{{ isAdmin() }}") {
                Swal.fire({
                    title: "Are you sure ?",
                    text: "Do you really want to delete this supplier? This process cannot be undone.",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ml-2 mt-2",
                    buttonsStyling: !1,
                }).then(function(t) {
                    if (t.value) {
                        $.ajax({
                            method: "delete",
                            url: "supplier/delete",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": id
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: "Supplier has been deleted",
                                        type: "success",
                                    })
                                    $(".delete-" + id).closest('tr').remove();
                                } else {
                                    Swal.fire({
                                        title: "Something went wrong please try again!",
                                        type: "error",
                                    })
                                }
                            }
                        })
                    } else {
                        Swal.fire({
                            title: "Supplier deletion cancelled",
                            type: "error",
                        })
                    }
                });
            } else {
                Swal.fire({
                    title: "Admin can only delete!",
                    type: "warning",
                })
            }

        }

        function viewSupplier(id) {
            $.ajax({
                method: "post",
                url: "supplier/view",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    if (response.success == 'success') {
                        $('.disp-bx').html(response.modal);
                        $('#edit-supp').modal('show');
                    } else {
                        Swal.fire({
                            title: "Something went wrong please try again!",
                            type: "warning",
                        })
                    }
                }
            })
        }
    </script>
    @endsection()