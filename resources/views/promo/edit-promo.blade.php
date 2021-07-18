@extends('layouts.simple')

@section('css_before')
    <link rel="stylesheet" type="text/css" href="{{ asset('/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
@endsection
@section('js_before')
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script>jQuery(function(){ Dashmix.helpers(['datepicker', 'select2']); });</script>
@endsection
@section('content')
<!-- Page Content -->
<div class="content">
    <!-- Quick Overview -->
    <h2 class="content-heading">
        <i class="fa fa-angle-right text-muted mr-1"></i> PROMO 
    </h2>
    <!-- END Quick Overview -->
    <div class="block block-rounded invisible" data-toggle="appear">
        
        <div class="block-content">
            <h6 class="text-left">ADD PROMO</h6>
            <form method="POST" id="create-user-form" action="/promo">
                @csrf       
                @method('put')
                <!-- Basic Elements -->
                    <input type="hidden"  name="id" value="{{ $value->id }}" required>
                    <div class="form-group row">
                        <label class="col-sm-3 ">Promo Name</label>
                        <div class="col-sm-3">
                            <input type="text" 
                                    class="form-control" 
                                    id="promo_name" 
                                    name="promo_name" 
                                    placeholder="Promo Name" 
                                    value="{{ $value->promo_name ??  old('promo_name') }}"
                                    minlength="3"
                                    maxlength="20"
                                    required>
                        </div>
                        <label class="col-sm-3 ">Company Vendor</label>
                        <div class="col-sm-3">
                            <input type="text" 
                                    class="form-control" 
                                    id="company_vendor" 
                                    name="company_vendor" 
                                    placeholder="Company Vendor" 
                                    value="{{ $value->company_vendor ??  old('company_vendor') }}"
                                    minlength="3"
                                    maxlength="100"
                                    required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 ">Kode</label>
                        <div class="col-sm-3">
                            <input type="text" 
                                    class="form-control" 
                                    id="code" 
                                    name="code" 
                                    placeholder="Code" 
                                    value="{{ $value->code ??  old('code') }}"
                                    minlength="3"
                                    maxlength="50"
                                    required>
                        </div>
                        <label class="col-sm-3 ">Quality</label>
                        <div class="col-sm-3">
                            <input type="number" 
                                    class="form-control" 
                                    id="qty" 
                                    name="qty" 
                                    placeholder="Quality" 
                                    value="{{ $value->qty ??  old('qty') }}"
                                    min="0"
                                    required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 ">Percentage</label>
                        <div class="col-sm-3">
                            <input type="text" 
                                    class="form-control" 
                                    id="percentage" 
                                    name="percentage" 
                                    placeholder="Percentage" 
                                    value="{{ $value->percentage ??  old('percentage') }}"
                                    min="0"
                                    required>
                        </div>
                        <label class="col-sm-3 ">Expired</label>
                        <div class="col-sm-3">
                            <input type="text" 
                                class="js-datepicker form-control w-100" 
                                required 
                                id="expired" 
                                name="expired" 
                                data-week-start="1" 
                                data-autoclose="true" 
                                data-today-highlight="true" 
                                value="{{ date('d-m-Y',strtotime($value->expired)) ?? old('expired') }}"
                                placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" />
                                
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 ">Status</label>
                        <div class="col-sm-3">
                            <select class="js-select2 form-control" id="status" name="status" style="width: 100%;" data-placeholder="Pilih Status" required>
                                <option value="1" @if($value->status == "1") selected @endif>OPEN</option>
                                <option value="0" @if($value->status == "0") selected @endif>CLOSED</option>
                            </select>
                        </div>
                        <label class="col-sm-3 ">Minimum Pembelian</label>
                        <div class="col-sm-3">
                            <input type="number" 
                                    class="form-control" 
                                    id="minimum_pembelian" 
                                    name="minimum_pembelian" 
                                    placeholder="Minimum Pembelian" 
                                    value="{{ $value->minimum_pembelian ?? old('minimum_pembelian') }}"
                                    min="0"
                                    required>
                                
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label class="col-sm-3 ">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" 
                                        id="description" 
                                        name="description" 
                                        rows="4" 
                                        placeholder="Description" required>{{ $value->description ?? old('description') }}</textarea>
                        </div>

                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-sm submit-loader" value="Simpan">
                        <a href="/promo">
                            <input type="button" class="btn btn-primary btn-sm submit-loader" value="Batalkan">
                        </a>
                    </div>

                    <!-- END Input Grid Sizes -->
            </form>

        </div>

    </div>
</div>
<!-- END Page Content -->



<script type="text/javascript">
   
</script>

@endsection 
