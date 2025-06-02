 @extends('layouts.app')
 @section('content')
 <style type="text/css">
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
       background-color: #4d4d4d; 
       opacity: 1;
    }
 </style>
        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid pt-25">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div  class="panel-body pb-0">
                                    <div  class="tab-struct custom-tab-1">
                                        <div class="tab-content" id="myTabContent_8">
                                            <div  id="settings_8" class="tab-pane fade active in" role="tabpanel">
                                                <!-- Row -->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="">
                                                            <div class="panel-wrapper collapse in">
                                                                <div class="panel-body pa-0">
                                                                    <div class="col-sm-12 col-xs-12">
                                                                        <div class="form-wrap">
                                                                            <form id="change_password_form" method="POST">
                                                                                <div class="form-body overflow-hide">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputuname_01">Old Password</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                                                            <input type="password" class="form-control" name="old_password" id="old_password">
                                                                                            <input type="hidden" name="user_id" id="user_id" value="{{Session::get('user_details')[0]['user_id']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputuname_01">New Password</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                                                            <input type="password" class="form-control" name="new_password" id="new_password">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputuname_01">Confirm Password</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-actions mt-10">            
                                                                                    <button type="submit" class="btn btn-primary mr-10 mb-30">Change Password</button>
                                                                                </div>              
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- /Row -->
            </div>
        </div>
        <!-- /Main Content -->
@endsection