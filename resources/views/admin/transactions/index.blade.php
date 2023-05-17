@extends('admin.layouts.app')
@section('page_title', __('Transaction'))
@section('css')
    <link rel="stylesheet" href="{{ asset('public/datta-able/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/product.min.css') }}">
@endsection
@section('content')

<!-- Main content -->
<div class="col-sm-12 list-container" id="transaction-list-container">
    <div class="card">
        <div class="card-header d-md-flex justify-content-between align-items-center">
            <h5>{{ __('Transactions') }}</h5>
            <div class="mt-md-0 mt-2">
                <button class="btn btn-outline-primary mb-0 me-0 custom-btn-small collapsed filterbtn" type="button" data-bs-toggle="collapse" data-bs-target="#filterPanel" aria-expanded="true" aria-controls="filterPanel"><span class="fas fa-filter">&nbsp;</span>{{ __('Filter') }}</button>
            </div>
        </div>
        <div class="card-header p-0 collapse" id="filterPanel">
            <div class="row mx-2 my-3">
                <div class="col-md-3">
                    <div class="input-group">
                        <button type="button" class="form-control filter-drop-down h-40 inputFiedlDesign" id="daterange-btn">
                            <span class="float-left"><i class="fa fa-calendar"></i> {{ __('Date range picker') }}</span>
                            <i class="fa fa-caret-down float-right pt-1"></i>
                        </button>
                    </div>
                </div>
                <input class="form-control" id="startfrom" type="hidden" name="from">
                <input class="form-control" id="endto" type="hidden" name="to">
                <div class="col-md-3">
                    <select class="select2 filter" name="transaction_type">
                        <option value="">{{ __('All Transaction Type') }}</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->transaction_type }}">{{ str_replace("_", " ", $type->transaction_type) }}</option>
                        @endforeach
                    </select>
                </div>

                <select class="filter display-none" name="start_date" id="start_date"></select>

                <select class="filter display-none" name="end_date" id="end_date"></select>
                @if(isset($users))
                <div class="col-md-2">
                    <select class="select2default filter filter-drop-down" name="user_id">
                        <option value="">{{ __('All Users') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->user->id }}">{{ $user->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                @if(isset($vendors))
                <div class="col-md-2">
                    <select class="select2default filter filter-drop-down" name="vendor_id">
                        <option value="">{{ __('All Vendors') }}</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->vendor->id }}">{{ $vendor->vendor->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-md-2">
                    <select class="select2 filter" name="status">
                        <option>{{ __('All Status') }}</option>
                        <option value="Accepted">{{ __('Accepted') }}</option>
                        <option value="Rejected">{{ __('Rejected') }}</option>
                        <option value="Pending">{{ __('Pending') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body px-4 product-table">
            <div class="card-block pt-2 px-0">
                <div class="col-sm-12">
                    @include('admin.layouts.includes.yajra-data-table')
                </div>
            </div>
        </div>
        @include('admin.layouts.includes.delete-modal')
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        'use strict';
        var pdf = "{{ (in_array('App\Http\Controllers\TransactionController@pdf', $prms)) ? '1' : '0' }}";
        var csv = "{{ (in_array('App\Http\Controllers\TransactionController@csv', $prms)) ? '1' : '0' }}";
    </script>
    <script src="{{ asset('public/datta-able/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/permission.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/withdrawal.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/custom/transaction.min.js') }}"></script>
@endsection

