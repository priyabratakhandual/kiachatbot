@extends('layouts.app')  
@section('content')

<style type="text/css">
    body{
        color:black !important;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    .dataTables_processing{
    color: black !important;
    height: 60px !important;
    }
    .buttons-excel{
        margin-left:40px !important;
        background:gray;
    }
    td.details-control {
        background: url('{{ asset('img/details_open.png') }}') no-repeat center center !important;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('{{ asset('img/details_close.png') }}') no-repeat center center !important;
    }
    .badge-adi{
            background-color: #0090bf;
            font-weight: 400;
            padding: 5px 10px;
            color: #ffffff;
    }
    .dataTables_filter{
        display: none;
    }
</style>

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    {{-- <div id="reportrange" style="background: #000;color: white; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>From</label>
                                            <input type="text" name="from" id="startDate" class="form-control datepicker" placeholder="from" autocomplete="off">
                                        </div>
                                        <div class="col-md-6">
                                            <label>To</label>
                                            <input type="text" name="to" id="endDate" class="form-control datepicker" placeholder="to" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <a href="{{URL::to('activity/create')}}">
                                        <button class="pull-right btn btn-success"  style="background:#a80008">Create Plan</button>
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('export-feeback')}}">
                                        <button class="pull-right btn btn-success"  style="background:#a80008">Export Feedback</button>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body row pa-0">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table display product-overview border-none" id="activity_table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Activity ID</th>
                                                        {{-- <th>Participants</th>
                                                        <th>Attendance recieved</th>
                                                        <th>Feedback Received</th> --}}
                                                        <th>Act. Date (FROM)</th>
                                                        <th>Act. Date (TO)</th>
                                                        <th>Activity Type</th>
                                                        <th>Region</th>
                                                        <th>Dealer Code</th>
                                                        <th>Module</th>
                                                        <th>Trainer</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                    <tfoot>
                                                        <tr>
                                                        <th></th>
                                                        <th>Activity ID</th>
                                                        <th>Act. Date (FROM)</th>
                                                        <th>Act. Date (TO)</th>
                                                        <th>Activity Type</th>
                                                        <th>Region</th>
                                                        <th>Dealer Code</th>
                                                        <th>Module</th>
                                                        <th>Trainer</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        {{-- <th>Participants</th>
                                                        <th>Attendance recieved</th>
                                                        <th>Feedback Received</th> --}}
                                                        </tr>
                                                    </tfoot>
                                            </table>
                                        </div>
                                    </div>  
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->
        </div>
            
@endsection