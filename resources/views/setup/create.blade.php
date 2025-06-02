@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">CREATE SETUP</h5>
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
													<form id="add_go_ahead_form" class="form-horizontal">
														@csrf
														<div class="form-body">
{{-- 															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Person's Info</h6>
 --}}															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Additional Comments</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="additional_comment" id="additional_comment">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Live date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="live_date0" id="live_date0">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Site Rediness</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="site_rediness" id="site_rediness">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Payment status</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="payment_status" id="payment_status">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dxc remark</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dxc_remark" id="dxc_remark">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Netware</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="netware" id="netware">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Parent Group</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="parent_group" id="parent_group">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer map code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_map_code" id="dealer_map_code">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Check</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="check" id="check">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Creation date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="creation_date" id="creation_date">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">live date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="live_date1" id="live_date1">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer type</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_type" id="dealer_type">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">sale</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="sale" id="sale">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer sub type</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_sub_type" id="dealer_sub_type">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Srv yn</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="srv_yn" id="srv_yn">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">live date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="live_date2" id="live_date2">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">srv live date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="srv_live_date" id="srv_live_date">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">sal live date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="sal_live_date" id="sal_live_date">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">R-outlet/tv</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="r_outlet" id="r_outlet">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">outstation/local</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="outstation_local" id="outstation_local">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">within 100 km</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="within_100_km" id="within_100_km">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">last visited</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="last_visited1" id="last_visited1">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">visited</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="visited" id="visited">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Site status</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="site_status" id="site_status">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Fa</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealerfa" id="dealerfa">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Sale Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="sale_code" id="sale_code">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">last visited</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="last_visited2" id="last_visited2">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer type</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_type2" id="dealer_type2">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer sub type 2</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_sub_type2" id="dealer_sub_type2">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Address</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="address" id="address">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Category</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="category" id="category">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">local/outstation as per base</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="local_outstation_as_per_base" id="local_outstation_as_per_base">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">additonal remark</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="remark_by_us" id="remark_by_us">
																		</div>
																	</div>
																</div>

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