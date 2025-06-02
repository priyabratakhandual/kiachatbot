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
                    <div class="col-lg-3 col-xs-12">
                        <div class="panel panel-default card-view  pa-0 bg-gradient">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body  pa-0">
                                    <div class="profile-box">
                                        <div class="profile-cover-pic">{{-- 
                                            <div class="fileupload btn btn-default">
                                                <span class="btn-text">edit</span>
                                                <input class="upload" type="file">
                                            </div> --}}
                                            <div class="profile-image-overlay" style="background-image:url('{{asset('/kia-bonnet-badge-660x380.jpg')}}');background-size:cover;opacity:0.7;"></div>
                                        </div>
                                        <div class="profile-info text-center">
                                            <div class="profile-img-wrap">
                                                <img class="inline-block mb-10" src="{{asset('/user.png')}}" alt="user"/>{{-- 
                                                <div class="fileupload btn btn-default">
                                                    <span class="btn-text">edit</span>
                                                    <input class="upload" type="file">
                                                </div> --}}
                                            </div>  
                                            <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-warning">{{$user->name}}</h5>
                                            <h6 class="block capitalize-font pb-20 txt-light">{{Session::get('user_details')[0]['role']}}</h6>
                                        </div>  
                                       {{--  <div class="social-info">
                                            <div class="row">
                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font txt-light"><span class="counter-anim">345</span></span>
                                                    <span class="counts-text block txt-light">post</span>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font txt-light"><span class="counter-anim">246</span></span>
                                                    <span class="counts-text block txt-light">followers</span>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font txt-light"><span class="counter-anim">898</span></span>
                                                    <span class="counts-text block txt-light">tweets</span>
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-block btn-anim mt-30" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i><span class="btn-text">edit profile</span></button>
                                            <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Row -->
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="">
                                                                        <div class="panel-wrapper collapse in">
                                                                            <div class="panel-body pa-0">
                                                                                <div class="col-sm-12 col-xs-12">
                                                                                    <div class="form-wrap">
                                                                                        <form action="#">
                                                                                            <div class="form-body overflow-hide">
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label mb-10" for="exampleInputuname_1">Name</label>
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                                                        <input type="text" class="form-control" id="exampleInputuname_1" placeholder="willard bryant">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                                                                        <input type="email" class="form-control" id="exampleInputEmail_1" placeholder="xyz@gmail.com">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label mb-10" for="exampleInputContact_1">Contact number</label>
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                                                        <input type="email" class="form-control" id="exampleInputContact_1" placeholder="+102 9388333">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label mb-10" for="exampleInputpwd_1">Password</label>
                                                                                                    <div class="input-group">
                                                                                                        <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                                                                        <input type="password" class="form-control" id="exampleInputpwd_1" placeholder="Enter pwd" value="password">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label mb-10">Gender</label>
                                                                                                    <div>
                                                                                                        <div class="radio">
                                                                                                            <input type="radio" name="radio1" id="radio_1" value="option1" checked="">
                                                                                                            <label for="radio_1">
                                                                                                            M
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="radio">
                                                                                                            <input type="radio" name="radio1" id="radio_2" value="option2">
                                                                                                            <label for="radio_2">
                                                                                                            F
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="control-label mb-10">Country</label>
                                                                                                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                                                                        <option value="Category 1">USA</option>
                                                                                                        <option value="Category 2">Austrailia</option>
                                                                                                        <option value="Category 3">India</option>
                                                                                                        <option value="Category 4">UK</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-actions mt-10">            
                                                                                                <button type="submit" class="btn btn-primary mr-10 mb-30">Update profile</button>
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
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Save</button>
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-xs-12">
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
                                                                            <form id="profile_update_form" method="POST">
                                                                                <div class="form-body overflow-hide">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputuname_01">Name</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                                                                            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputEmail_01">Email address</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                                                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label mb-10" for="exampleInputuname_01">Employee Code</label>
                                                                                        <div class="input-group">
                                                                                            <input type="text" class="form-control" name="emp_code" id="emp_code" value="{{$user->emp_code}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-actions mt-10">            
                                                                                    <button type="submit" class="btn btn-primary mr-10 mb-30">Update profile</button>
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