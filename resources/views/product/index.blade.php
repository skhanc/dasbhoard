@extends('layouts.master')

@section('title', 'Users')

@section('css')
    <link href="{{URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Users @endslot
        @slot('li_1') Listing @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="d-flex justify-content-end mb-2">
                        <button class="btn btn-dark bg-dark-red btn-sm" data-toggle="modal"
                                data-target="#create-product-modal"
                                id="create-new-member">Create
                            New Product
                        </button>
                    </div>

                    <table class="table datatable table-bordered dt-responsive nowrap w-100"
                           style="border-collapse: collapse; border-spacing: 0;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-ml" id="create-product-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-ml">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Create Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-product" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span style="color: red"> *</span></label>
                                    <input name="name" type="text" class="form-control" placeholder="Name"
                                           data-parsley-minlength="3" data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Quantity<span style="color: red"> *</span></label>
                                    <input name="quantity" type="text" class="form-control" placeholder="Quantity"
                                           data-parsley-minlength="3" data-parsley-required="true"/>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Company</label>
                                    <select class="select2-selection select2-selection-single form-control"
                                            name="company_id" data-placeholder="Choose ..."
                                            id="product-company-id" data-parsley-required="true"
                                            data-parsley-required-message="select members">
                                        <option value=""> Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id }}">{{ $company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit"
                                            class="btn btn-dark bg-dark-red waves-effect waves-light mr-1 add-spinner"
                                            data-size="xs">
                                        Create
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="edit-product-modal" tabindex="-1" role="dialog"
         aria-labelledby="edit-user"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="edit-company">Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update-product-form">

                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span style="color: red"> *</span></label>
                                    <input name="name" type="text" class="form-control" id="edit_company_name"
                                           placeholder="Name" data-parsley-minlength="3" data-parsley-required="true"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Quantity<span style="color: red"> *</span></label>
                                    <input name="quantity" type="text" class="form-control" placeholder="Quantity"
                                        id="edit_company_quantity"   data-parsley-minlength="3" data-parsley-required="true"/>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="select2-selection select2-selection-single form-control "
                                            name="company_id" data-placeholder="Choose ..."
                                            id="edit_company_id" data-parsley-required="true"
                                            data-parsley-required-message="select members">
                                        @foreach($companies as $company)
                                            <option value="{{$company->id }}">{{ $company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit"
                                            class="btn btn-dark bg-dark-red waves-effect waves-light mr-1 add-spinner"
                                            data-size="xs">
                                        Update
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@include('product.ajax.index')


