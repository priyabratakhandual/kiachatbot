@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Add User</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							{{-- <ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol> --}}
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->
					
					
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form id="add_user_form" class="form-horizontal">
														@csrf
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Person's Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Name</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" placeholder="Name" name="name" id="name">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Email</label>
																		<div class="col-md-9">
																			<input type="email" class="form-control" placeholder="email" name="email" id="email">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Role</label>
																		<div class="col-md-9">
																			<select class="form-control" name="role" id="role">
																				@foreach($roles as $role)
																				<option value="{{$role}}">{{$role}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<!--/span-->
															<div id="if_fe" style="display:none;">
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Mobile</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="mobile" id="mobile">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region code</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="region_code" id="region_code">
																				@foreach($region_codes as $region_code)
																				<option value="{{$region_code}}">{{$region_code}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Emp Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="emp_code" id="emp_code">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">State Code</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="state_code" id="state_code">
																				@foreach($state_codes as $state_code)
																				<option value="{{$state_code}}">{{$state_code}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Password</label>
																		<div class="col-md-9">
																			<input type="password" class="form-control" name="password" id="password">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Confirm Password</label>
																		<div class="col-md-9">
																			<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>

															<div class="seprator-block"></div>
{{-- 															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>address</h6>
															<hr class="light-grey-hr"/>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Address 1</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Address 2</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">City</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">State</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Post Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Country</label>
																		<div class="col-md-9">
																			<select class="form-control">
																				<option>Country 1</option>
																				<option>Country 2</option>
																			</select>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row --> --}}
														</div>
														<div class="form-actions mt-10">
															<div class="row">
																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-6">
																			<button type="submit" class="btn btn-success  mr-10">Submit</button>
																		</div>
																	</div>
																</div>
																<div class="col-md-6"> </div>
															</div>
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
					<!-- /Row -->

				</div>
			
			</div>
			<!-- /Main Content -->


@endsection