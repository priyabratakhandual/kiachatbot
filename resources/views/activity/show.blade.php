@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">UPDATE PLAN</h5>
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
													<form id="create_activity_form" class="form-horizontal">
														{{csrf_field()}}
														<div class="form-body">
															{{-- <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6> --}}
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Activity Date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="plan_date" id="plan_date" value="{{$details->plan_date}}">
																			<input type="hidden" name="update" value="true">
																			<input type="hidden" name="plan_id" value="{{$details->id}}">

																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Activity Type</label>
																		<div class="col-md-9">
																			<select class="form-control" id="activity_type" name="activity_type[]" multiple="multiple">
                                                                                <?php $activity_type = explode(', ',$details->activity_type); ?>
																				<option value="Dealer Training" <?php echo ((in_array('Dealer Training',$activity_type))?'selected':'')?>>Dealer Training</option>
																				<option value="Regional Training" <?php echo ((in_array('Regional Training',$activity_type))?'selected':'')?>>Regional Training</option>
																				<option value="RTC Training" <?php echo ((in_array('RTC Training',$activity_type))?'selected':'')?>>RTC Training</option>
																				<option value="Roll Out" <?php echo ((in_array('Roll Out',$activity_type))?'selected':'')?>>Roll Out</option>
																				<option value="Internal Training" <?php echo ((in_array('Internal Training',$activity_type))?'selected':'')?>>Internal Training</option>
																				<option value="KIN New Joining" <?php echo ((in_array('KIN New Joining',$activity_type))?'selected':'')?>>KIN New Joining</option>
																				<option value="Pre-Roll Out" <?php echo ((in_array('Pre-Roll Out',$activity_type))?'selected':'')?> >Pre-Roll Out</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">No. Of Man Days</label>
																		<div class="col-md-9">
																			<input class="form-control" type="number" name="no_of_men_days" id="no_of_men_days" value="{{$details->no_of_men_days}}">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region</label>
																		<div class="col-md-9">
																			<select class="form-control" id="region" name="region[]" multiple="multiple">
                                                                                <?php $region = explode(', ',$details->region);?>
																				<option value="North" <?php echo ((in_array('North',$region))?'selected':'')?>>North</option>
																				<option value="East" <?php echo ((in_array('East',$region))?'selected':'')?>>East</option>
																				<option value="West" <?php echo ((in_array('West',$region))?'selected':'')?>>West</option>
																				<option value="South" <?php echo ((in_array('South',$region))?'selected':'')?>>South</option>
																				<option value="Globtier Internal Training" <?php echo ((in_array('Globtier Internal Training',$region))?'selected':'')?>>Globtier Internal Training</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code</label>
																		<div class="col-md-9">
																			<select class="form-control" id="dealer_code" name="dealer_code[]" multiple="multiple">
                                                                                <?php $dealer_code = explode(', ',$details->dealer_code);?>
																				@foreach($dealers as $dealer)

																				<option value="{{$dealer->Dealer_code}}" <?php echo ((in_array($dealer->Dealer_code,$dealer_code))?'selected':'')?>>{{ $dealer->Dealer_code }} -- {{ $dealer->Dealership_Name }}</option>

																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Trainer</label>
																		<div class="col-md-9">
																			<select class="form-control" id="trainer" name="trainer[]" multiple="multiple">
                                                                                <?php $train = explode(', ',$details->trainer_id);?>

																				@foreach($trainers as $trainer)

																				<option value="{{$trainer->id}}" <?php echo ((in_array($trainer->id,$train))?'selected':'')?>>{{ $trainer->name }}</option>																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Module</label>
																		<div class="col-md-9">
																			<select class="form-control" name="module[]" id="module" multiple="multiple">
                                                                                <?php $module = explode(', ',$details->module); ?>
																				<option value="DMS Sales" <?php echo ((in_array('DMS Sales',$module))?'selected':'')?>>DMS Sales</option>
																				<option value="DMS Service" <?php echo ((in_array('DMS Service',$module))?'selected':'')?>>DMS Service</option>
																				<option value="My Sales" <?php echo ((in_array('My Sales',$module))?'selected':'')?>>My Sales</option>
																				<option value="CVISI" <?php echo ((in_array('CVISI',$module))?'selected':'')?>>CVISI</option>
																				<option value="Warranty" <?php echo ((in_array('Warranty',$module))?'selected':'')?>>Warranty</option>
																				<option value="CRM" <?php echo ((in_array('CRM',$module))?'selected':'')?>>CRM</option>
																				<option value="Driver App" <?php echo ((in_array('Driver App',$module))?'selected':'')?>>Driver App</option>
																				<option value="BI-Sales" <?php echo ((in_array('BI-Sales',$module))?'selected':'')?>>BI-Sales</option>
																				<option value="BI-After Sales" <?php echo ((in_array('BI-After Sales',$module))?'selected':'')?>>BI-After Sales</option>
																				<option value="BI-Warranty" <?php echo ((in_array('BI-Warranty',$module))?'selected':'')?>>BI-Warranty</option>
																				<option value="BI-All" <?php echo ((in_array('BI-All',$module))?'selected':'')?>>BI-All</option>
																				<option value="All" <?php echo ((in_array('All',$module))?'selected':'')?>>All</option>
																				<option value="Others" <?php echo ((in_array('Others',$module))?'selected':'')?>>Others</option>
																				<option value="KIA CPO" <?php echo ((in_array('KIA CPO',$module))?'selected':'')?>>KIA CPO</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Remarks</label>
																		<div class="col-md-9">
																			<textarea class="form-control" name="remarks" id="remarks">{{$details->remarks}}</textarea>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Training Type</label>
																		<div class="col-md-9">
																			<select class="form-control" name="training_type" id="training_type">
                                                                                <?php $training_type = explode(', ',$details->training_type);?>
																				<option value="Onsite" <?php echo ((in_array('Onsite',$training_type))?'selected':'')?>>Onsite</option>
																				<option value="Online" <?php echo ((in_array('Online',$training_type))?'selected':'')?>>Online</option>
																			</select>
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
																			<button type="submit" class="btn btn-success  mr-10">Update</button>
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
