@extends('layouts.auth.master')
@section('content')
          <style type="text/css">
              .error-block{
                color: red;
              }    


/*-------------extra css style-----------*/


.top-hdr {
    border-bottom: 1px solid #ccc;
    height: 65px;
    margin: 0px 40px;
    padding: 0px;
}
    .page-wrapper.auth-page {
    background: #fff;
}
.wrapper {
    background: #fff;
}
.header-left, 
.header-center, left: -15px;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}
.header-top .header-right {
    align-items: stretch;
}
.header-center, .header-right {
    margin-left: auto;
}
.right-algn {
    display: block;
    text-align: right;
    margin-right: -15px;
}
.hding{

}
.form-wrap .icon.left {
    left: 18px;
}
.form-wrap .icon {
    position: absolute;
    width: 30px;
    height: 20px;
    top: 12px;
    color: #000;
    transition: all 0.4s ease;
    border-right: 1px solid #000;
}
.icon .user {
    width: 20px;
    height: 10px;
    bottom: 1px;
    left: 5px;
    box-shadow: 0 0 0 2px #000 inset;
    border-radius: 6px 6px 3px 3px;
}
.form-wrap .icon i {
    position: absolute;
    display: block;
}
.icon .user::before {
    width: 10px;
    height: 10px;
    top: -10px;
    left: 5px;
    box-shadow: 0 0 0 2px #000 inset;
    border-radius: 50%;
}
.form-wrap .icon i::before, .form-wrap .icon i::after {
    position: absolute;
    content: "";
}
.form-control {
    padding: 6px 12px 6px 40px;
    }

.icon .lock {
    width: 20px;
    height: 16px;
    top: 4px;
    left: 5px;
    box-shadow: 0 0 0 2px #000 inset;
    border-radius: 3px;
}
.icon .lock::before {
    width: 8px;
    height: 8px;
    top: -5px;
    left: 6px;
    border: 2px solid transparent;
    border-top: 2px solid #000;
    border-right: 2px solid #000;
    border-radius: 50%;
    transform: rotate(-45deg);
}
.icon .lock::after {
    width: 6px;
    height: 7px;
    top: 2px;
    left: 7px;
    box-shadow: 0 0 0 2px #000 inset;
}
.form-wrap .icon.right {
    left: 18px;
}

.form-wrap .icon2 {
    position: absolute;
    width: 30px;
    height: 20px;
    top: 68px;
    transition: all 0.4s ease;
}
.form-wrap .bg56::after{

}
.btn.btn-primary{
    background: #000;
    border: solid 1px #000;
    width: 100%;
    border-radius: 4px;
}
.btn.btn-primary:hover{
    background: #000;
    border: solid 1px #000;
    width: 100%;
    border-radius: 4px;
}
.form-control{
    border: 1px solid #000;
    background-color: #f7f7f7;
    border-radius: 0;
    box-shadow: none;
    color: #fff;
    height: 42px;
}
.chkbx {
    top: 2px;
    position: relative;
    margin-right: 5px !important;
}
.card-view {
    background: #fff;
    margin-bottom: 0px;
    border: none;
    border-radius: 0;
    box-shadow: none;
    padding: 0px 15px 0;
}
.auth-form-wrap {
    padding: 40px 0 40px 0;
}
.center{
text-align:center;
}
.height200{
height:auto !important;
}
body {
    overflow-x: hidden;
}

.form-control {
    color: #2e2e2e;
}




    
          </style>  
            <!-- Main Content -->
            <div class="page-wrapper pa-0 ma-0 auth-page">
                <div class="container-fluid">
                    <div class="row">
                        <div class="top-hdr">
                            <div class="col-sm-6 col-xs-6">
                                <div class="header-left">
                                    <img style="padding: 10px;" src="https://kia.tutorial.inhelpdesk.com/Kia-logo.png" width="115" height="60">
                                 </div>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <div class="header-right right-algn">
                                    <img src="{{asset('img/globtierlogo.png')}}" width="145" height="60">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row -->
                    <div class="table-struct full-width full-height height200">
                        <div class="table-cell vertical-align-middle auth-form-wrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="hding">Training Management System</h4>
                                </div>
                            </div>
                            <div class="col-sm-8 center">
<img src="{{asset('img/kia-cars.png')}}" style="width: 70%">
                            </div>
                            <div class="col-sm-4">                                    
                                <div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
                                    <div class="row">                                    
                                        <div class="col-sm-12 col-xs-12">  
                                            <div class="form-wrap">
                                                <form action="{{ URL::to('/loginCheck') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group bg56">
                                                        <div class="icon left"><i class="user"></i></div>
                                                        <input type="email" class="form-control is-invalid" name="email" id="email" placeholder="User ID" value="{{ old('email') }}">
                                                        {!! $errors->first('email', '<div class="error-block">:message</div>') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        {{-- <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="forgot-password.html">forgot password ?</a> --}}
                                                        <div class="clearfix"></div>
                                                        <div class="icon left icon2 right"><i class="lock"></i></div>
                                                        <input type="password" class="form-control"  name="password" id="password" placeholder="Password">
                                                        {!! $errors->first('password', '<div class="error-block">:message</div>') !!}
                                                    </div> 
						  
                                                    <div class="form-group">
                                                        <input type="checkbox" id="" name="Save ID" value="Save ID">
                                                        <label for="vehicle1"> Save ID</label>
                                                    </div>                                       
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-primary  btn-rounded">sign in</button>
                                                    </div>
                                                </form>
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
