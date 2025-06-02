@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">VISIT PLAN</h5>
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
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info mr-10"></i>Details</h6>
															<hr class="light-grey-hr"/>
															<div> 
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer_name</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->dealer_name}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">for_code</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->for_code}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">outlet_code</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->outlet_code}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">dealer_map_code</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->dealer_map_code}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">loc_map_code</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->loc_map_code}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">region</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->region}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">location address</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->loc_address}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">city</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->city}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">location_type</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->location_type}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">agenda_of_visit</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->agenda_of_visit}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">visit_planned_date</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->visit_planned_date}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">actual_date_of_visit</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->actual_date_of_visit}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">reason_for_reschedule</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->reason_for_reschedule}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">agenda_complete</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->agenda_complete}}</p>
																		</div>
																	</div>
																</div>
															</div>
															</div>
														</div>
{{-- 														<div class="form-actions mt-10">
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
														</div> --}}
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