@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">PLAN COMPLETION</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							{{-- <ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol> --}}
							<a href="{{URL::to('/dashboard')}}"><button class="btn btn-primary" style="float: right;">BACK</button></a>
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
													<form id="work_on_activity_form" class="form-horizontal">
														{{csrf_field()}}
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Plan Date:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->plan_date}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Activity Type:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->activity_type}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Activity date:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->activity_date}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->region}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->dealer_code}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Trainer:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->trainer_name}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Module</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->module}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Training Type</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->training_type}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Number Of Participants</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->no_of_participant}}</p>
																		</div>
																	</div>
																</div>
																@if($details->attendance)
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Attendance</label>
																		<div class="col-md-9">
																			<a href="<?php echo 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $details->id .'/attendance/' . $details->attendance ?>" download><p class="form-control-static text-primary">download</p></a>
																		</div>
																	</div>
																</div>
																@endif
															</div>
															<div class="row">
																@if($details->site_readiness)
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Site Readliness</label>
																		<div class="col-md-9">
																			<a href="<?php echo 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $details->id .'/site_readliness/' . $details->site_readiness ?>" download><p class="form-control-static text-primary">download</p></a>
																		</div>
																	</div>
																</div>
																@endif
																@if($details->speed_test)
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Speed Test</label>
																		<div class="col-md-9">
																			<a href="<?php echo 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $details->id .'/speed_test/' . $details->speed_test ?>" download><p class="form-control-static text-primary">download</p></a>
																		</div>
																	</div>
																</div>
																@endif
															</div>
															<div class="row">
																@if($details->sign_off_doc)
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Sign Off Documents</label>
																		<div class="col-md-9">
																			<a href="<?php echo 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $details->id .'/sign_off_docs/' . $details->sign_off_doc ?>" download><p class="form-control-static text-primary">download</p></a>
																		</div>
																	</div>
																</div>
																@endif
																@if($details->training_pics)
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Training Photo</label>
																		<div class="col-md-9">
																			<a href="<?php echo 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $details->id .'/training_photos/' . $details->training_pics ?>" download><p class="form-control-static text-primary">download</p></a>
																		</div>
																	</div>
																</div>
																@endif
															</div>
															<div class="row">
																@if($details->other_doc)
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Other Documents</label>
																		<div class="col-md-9">
																			<a href="<?php echo 'https://kia.chatbot.inhelpdesk.com/storage/documents/activity_info/' . $details->id .'/other_docs/' . $details->other_doc ?>" download><p class="form-control-static text-primary">download</p></a>
																		</div>
																	</div>
																</div>
																@endif
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Reschedule Date</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->reschedule_date}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Status</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{ $details->status}}</p>
																		</div>
																	</div>
																</div>
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