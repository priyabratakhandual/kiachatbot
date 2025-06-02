@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Dealer Details</h5>
						</div>
{{-- 					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb --> --}}
					
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
													<form class="form-horizontal" action="<?php echo URL::to('/activeDealer/edit') .'/'.$details->id ?>" role="form" method="POST">
														@csrf
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Name:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_NAME" id="DEALER_NAME" value="{{$details->DEALER_NAME}}">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Parent Group:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="PARENT_GROUP" id="PARENT_GROUP" value="{{$details->PARENT_GROUP}}">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Map Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_MAP_CD" id="DEALER_MAP_CD" value="{{$details->DEALER_MAP_CD}}">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="LOC_CD" id="LOC_CD" value="{{$details->LOC_CD}}">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Consignee Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="CONSG_CD" id="CONSG_CD" value="{{$details->CONSG_CD}}">
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Creation Date:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Creation_Date" id="Creation_Date" value="{{$details->Creation_Date}}">
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Live Date:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Live_Date" id="Live_Date" value="{{$details->Live_Date}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">For Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="FOR_CD" id="FOR_CD" value="{{$details->FOR_CD}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Mul Dealer Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="MUL_DEALER_CD" id="MUL_DEALER_CD" value="{{$details->MUL_DEALER_CD}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Type:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_TYPE" id="DEALER_TYPE" value="{{$details->DEALER_TYPE}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Sale:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="sale" id="sale" value="{{$details->sale}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Sub Type:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_SUB_TYPE" id="DEALER_SUB_TYPE" value="{{$details->DEALER_SUB_TYPE}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Outlet Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="OUTLET_CD" id="OUTLET_CD" value="{{$details->OUTLET_CD}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Category</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_CATEGORY" id="" value="{{$details->DEALER_CATEGORY}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">SRV</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="SRV_YN" id="SRV_YN" value="{{$details->SRV_YN}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">SRV live date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="SRV_LIVE_DATE" id="SRV_LIVE_DATE" value="{{$details->SRV_LIVE_DATE}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Sal Live Date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="SAL_LIVE_DATE" id="SAL_LIVE_DATE" value="{{$details->SAL_LIVE_DATE}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">R-Outlet/tv</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="ROutlet_TV" id="ROutlet_TV" value="{{$details->ROutlet_TV}}">
																		</div>
																	</div>
																</div>
															</div> 
															
															<div class="seprator-block"></div>
															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>address</h6>
															<hr class="light-grey-hr"/>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">State Code:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="STATE_CD" id="STATE_CD" value="{{$details->STATE_CD}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region Code :</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="REGION_CD" id="REGION_CD" value="{{$details->REGION_CD}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">City Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="CITY_CD" id="CITY_CD" value="{{$details->CITY_CD}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">City :</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="City_Name" id="City_Name" value="{{$details->City_Name}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Address 1:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_ADDRESS1" id="DEALER_ADDRESS1" value="{{$details->DEALER_ADDRESS1}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Address 2:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_ADDRESS2" id="DEALER_ADDRESS2" value="{{$details->DEALER_ADDRESS2}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Address 3:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_ADDRESS3" id="DEALER_ADDRESS3" value="{{$details->DEALER_ADDRESS3}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Pincode</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_PINCODE" id="DEALER_PINCODE" value="{{$details->DEALER_PINCODE}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location Description</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="LOC_DESC" id="LOC_DESC" value="{{$details->LOC_DESC}}">
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="seprator-block"></div>
															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>Visit Status</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Visit Required:</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Visit_Require" id="Visit_Require" value="{{$details->Visit_Require}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Visit type</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Outstation_Local" id="Outstation_Local" value="{{$details->Outstation_Local}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Within 100km</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="With_In_100KM" id="With_In_100KM" value="{{$details->With_In_100KM}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Last Visited</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Last_Visited" id="Last_Visited" value="{{$details->Last_Visited}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Site Status</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Site_Status" id="Site_Status" value="{{$details->Site_Status}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Sale Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="Sale_Code" id="Sale_Code" value="{{$details->Sale_Code}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Type FE</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="DEALER_TYPE_FE" id="DEALER_TYPE_FE" value="{{$details->DEALER_TYPE_FE}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Outstation/local as per basecity</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="outstation_local_as_per_basecity" id="outstation_local_as_per_basecity" value="{{$details->outstation_local_as_per_basecity}}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">FE Name</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="FE_Name" id="FE_Name" value="{{$details->FE_Name}}">
																		</div>
																	</div>
																</div>
															</div>	
														</div>
														<div class="form-actions mt-10">
															<div class="row">
																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-offset-3 col-md-9">
																			<button type="submit" value="submit" class="btn btn-info btn-icon left-icon  mr-10"> <i class="zmdi zmdi-edit"></i> <span>Save</span></button>
																			<a href="<?php echo URL::to('/activeDealer') ?>" type="button" class="btn btn-default">Back</a>
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