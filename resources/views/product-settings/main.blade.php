@extends('layouts.simple')

@section('content')
<!-- Page Content -->
<div class="content">
    <!-- Quick Overview -->
    <h2 class="content-heading">
        <i class="fa fa-angle-right text-muted mr-1"></i> PRODUCT SETTINGS 
    </h2>
    <!-- END Quick Overview -->
    <div class="block block-rounded invisible" data-toggle="appear">
        
        <div class="block-content">
            <h6 class="text-left">DAFTAR ALL PASPOR</h6>

            <div class="form-group row">
                <div class="block-content">

                    <div class="input-group">
                        <select id="filterByAll" name="filterByAll" class="form-control col-2 filterByAll">
                            <option value="NamaCustomer">Nama Customer</option>
                            <option value="Nama">Nama Paspor</option>
                            <option value="NoPaspor">No Paspor</option>
                        </select>
                        <input type="text" class="form-control col-4" id="srcField5"  placeholder="Search"> 
                        <div class="input-group-prepend col-3">
                            <button 
                                id="search-btn-all" 
                                type="button" 
                                class="btn btn-primary w-100">
                                <i class="fa fa-search mr-1"></i> Search
                            </button>
                        </div> 
                        <div class="col-md-3 right-margin">
                            <a href="/manage-paspor/add-paspor">
                                <button class="btn btn-primary float-right link-button">
                                    <i class="fa fa-plus"></i> Tambah Paspor  
                                </button>
                            </a>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="table-responsive">
                    <table id="table_form" class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination" style="width:100%">
                    <thead class="text-center" >
                        <tr>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Harga Per Liter</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody >
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
<!-- END Page Content -->



<script type="text/javascript">
    $( document ).ready(function() {

        listdata();
        
        $( "#search-btn-all" ).click(function() {
            var filter_data = $('#srcField5').val();
            var filter      = $('#filterByAll').val();
            if(filter_data != '')
            {
                $('#table_form').DataTable().destroy();
                listdata(filter_data,filter);
            }
            else
            {
                $('#table_form').DataTable().destroy();
                listdata();
            }
        });

        $("#srcField5").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                var filter_data = $('#srcField5').val();
                var filter      = $('#filterByAll').val();
                if(filter_data != '')
                {
                    $('#table_form').DataTable().destroy();
                    listdata(filter_data,filter);
                }
                else
                {
                    $('#table_form').DataTable().destroy();
                    listdata();
                }
            }
        });

        function listdata(filter_data = '',filter = ''){

            // create table form using datatable
            var table = $('#table_form').DataTable( {
                processing: true,
                serverSide: true,
                aaSorting:[[0,'asc']],
                columnDefs: [{ 
                            orderable: false, 
                            targets: [2,-1]
                        }],
                ajax:{
                        "url"       : "product-settings/getData",
                        "dataType"  : "json",
                        "type"      : "post",
                        "data"      :
                                        { 
                                            _token: "{{csrf_token()}}",
                                            search: filter_data,
                                            filter: filter
                                        }
                    },
                columns: [
                    { "data": "Product Name"},
                    { "data": "Brand"},
                    { "data": "Harga Per Liter"},
                    { "data": "Last Update"},
                    { "data": "Status"},
                    { "data": "Action"},
                ],
                language: {
                    search: '',
                    searchPlaceholder: "Search...",
                    paginate: {
                            first: '<i class="fa fa-angle-double-left"></i>',
                            previous: '<i class="fa fa-angle-left"></i>',
                            next: '<i class="fa fa-angle-right"></i>',
                            last: '<i class="fa fa-angle-double-right"></i>'
                        }
                },

            });
            $('.dataTables_filter').addClass('d-none');
        }

        // hide Search Datatable
        $('.dataTables_filter').addClass('d-none');
        $('.dt-user').addClass("hide");

    });


</script>

@endsection 
