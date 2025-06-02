@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">CREATE DEALER</h5>
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
													<form id="add_dealer_form_own" class="form-horizontal">
														{{ csrf_field()}}
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region</label>
																		<div class="col-md-9">
																			<select class="form-control" name="region" id="region">
																				@foreach($regions as $region)
																				  <option value="{{$region->region}}">{{$region->region}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_code" id="dealer_code">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Name</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_name" id="dealer_name">
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