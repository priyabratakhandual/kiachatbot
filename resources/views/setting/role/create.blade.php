@extends('layouts.app')  
@section('content')
<style type="text/css">
	/* 
Generic Styling, for Desktops/Laptops 
*/
table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: #000; 
}
th { 
  background: #333; 
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid #000; 
  text-align: left; 
}
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	.responsive-table-input-matrix {
		display: block;
		position: relative;
		width: 100%;

		&:after {
			clear: both;
			content: '';
			display: block;
			font-size: 0;
			height: 0;
			visibility: hidden;
		}

		tbody {
			display: block;
			overflow-x: auto;
			position: relative;
			white-space: nowrap;
			width: auto;


			tr {
				display: inline-block;
				vertical-align: top;

				td {
					display: block;
					text-align: center;

					&:first-child {
						text-align: left;
					}
				}
			}
		}

		thead {
			display: block;
			float: left;
			margin-right: 10px;

			&:after {
				clear: both;
				content: "";
				display: block;
				font-size: 0;
				height: 0;
				visibility: hidden;
			}

			th:first-of-type {
				height: 1.4em;
			}

			th {
				display: block;
				text-align: right;

				&:first-child {
					text-align: right;
				}
			}
		}
	}
}
</style>

			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Add role</h5>
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
													<form id="create_role_form">
								                      @csrf
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Role Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label col-md-2">Name</label>
																		<div class="col-md-8">
																			<input type="text" class="form-control" name="rolename" id="rolename" placeholder="role name">
																		</div>
																		<div class="col-md-2"></div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label col-md-2">Reports To</label>
																		<div class="col-md-8">
																			<select class="form-control" name="reports_to" id="reports_to">
																				<option value="0">No one</option>
																				@foreach($roles as $role)
																				<option value="{{$role->id}}">{{$role->name}}</option>
																				@endforeach
																			</select>
																		</div>
																		<div class="col-md-2"></div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<!-- /Row -->
															<div class="seprator-block"></div>
															<input type="hidden" name="final_privilege" id="final_privilege" value="">
															<h6 class="txt-dark capitalize-font">Edit privileges of this profile</h6>
															<hr class="light-grey-hr"/>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-12">
																	<table class="responsive-table-input-matrix" id="privilege">
																		<thead>
																		<tr>
																			<th>Module</th>
																			<th>Read</th>
																			<th>Create</th>
																			<th>Delete</th>
																			<th id="edit">Edit</th>
																		</tr>
																		</thead>
																		<tbody>
                                                                        
                                                                        @foreach($modules as $module)
																		<tr>
																			<td>{{$module}}</td>
																			<td><input value="read {{$module}}" type="checkbox"></td> 
																			<td><input value="create {{$module}}" type="checkbox"></td>
																			<td><input value="delete {{$module}}" type="checkbox"></td>
																			<td><input value="edit {{$module}}" type="checkbox"></td>
																		</tr>
																		@endforeach

																		</tbody>
																	</table>
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