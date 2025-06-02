@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">CREATE VISIT PLAN</h5>
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
													<form method="post" action="{{URL::to('/visitplan')}}" class="form-horizontal">
														@csrf
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info mr-10"></i>Enter Details</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code</label>
																		<div class="col-md-9">
																			<input type="hidden" name="dealer_id" id="dealer_id">
																			<input type="text" class="form-control" name="dealer_code" id="dealer_code">
																		</div>
																	</div>
																</div>
															</div>
															<div id="show_later" style="display:none;"> 
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer_name</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_name" id="dealer_name">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">for_code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="for_code" id="for_code">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">outlet_code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="outlet_code" id="outlet_code">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer_map_code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_map_code" id="dealer_map_code">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">loc_map_code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="loc_map_code" id="loc_map_code">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">region</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="region" id="region">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">location address</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="loc_address" id="loc_address">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">city</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="city" id="city">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">location_type</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="location_type" id="location_type">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">agenda_of_visit</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="agenda_of_visit" id="agenda_of_visit">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">visit_planned_date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="visit_planned_date" id="visit_planned_date">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">actual_date_of_visit</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="actual_date_of_visit" id="actual_date_of_visit">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">reason_for_reschedule</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="reason_for_reschedule" id="reason_for_reschedule">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">agenda_complete</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="agenda_complete" id="agenda_complete">
																		</div>
																	</div>
																</div>
															</div>
															</div>
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