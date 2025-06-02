@extends('layouts.app')  

@section('content')
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid pt-25">
            <!-- Row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <form action="{{route('export-feeback-post')}}" method="POST" >
                        {{ csrf_field() }}
                        <div class="panel panel-default card-view">
                            <h1 class="text-center" >Export Feedback data</h1>

                        <div class="panel-heading">
                            <div class="pull-left">
                                {{-- <div id="reportrange" style="background: #000;color: white; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>From</label>
                                        <input type="text" name="from" id="startDate" class="form-control datepicker-2" required placeholder="from" autocomplete="off">
                                    </div>
                                    <div class="col-md-6">
                                        <label>To</label>
                                        <input type="text" name="to" id="endDate" class="form-control datepicker-2" required placeholder="to" autocomplete="off">
                                    </div>

                                </div>
                            </div>
                            <div class="pull-left" >
                                <button class="btn btn-outline btn-success btn-block mt-3" style="margin-top: 21px; margin-left:24px;"  >Export</button>

                            </div>
                            <div class="clearfix"></div>
                        </div>                            
                    </form>
                    </div>
                </div>
            </div>
            <!-- /Row -->
    </div>
@endsection