		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<?php  $role =  Session::get('user_details')[0]['role']; ?>
{{-- 				<li>
					<a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dealers</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="dashboard_dr" class="collapse collapse-level-1">
						<li>
							<a href="{{URL::to('/goahead')}}" >GO Ahead</a>
						</li>
						<li>
							<a href="{{URL::to('/setup')}}" >Set Up</a>
						</li>
						<li>
							<a href="{{URL::to('/activeDealer')}}" >Master</a>
						</li>
					</ul>
				</li> --}}
				<li>
					<a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="{{URL::to("/dashboard")}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
				</li>
				@if($role == 'manager')
				<li>
					<a class="{{ Request::is('trainers') ? 'active' : '' }}" href="{{URL::to("/trainers")}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Trainers</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
				</li>
				{{-- <li>
					<a class="{{ Request::is('dealers') ? 'active' : '' }}" href="{{URL::to("/dealers")}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Dealers</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
				</li> --}}
				@endif

				@if($role == 'manager')
				<li>
					<a class="{{ Request::is('Questions') ? 'active' : '' }}" href="{{URL::to("/Questions")}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Questions</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
				</li>
				@endif

				@if($role == 'manager')
				<li>
					<a class="{{ Request::is('trainers') ? 'active' : '' }}" href="{{URL::to("/activity/attendance-feeback")}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Activity Feedback</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
				</li>				
				@endif

				@if($role == 'manager')
				<li>
					<a class="{{ Request::is('trainers') ? 'active' : '' }}" href="{{URL::to("/activity/ticket-feedback")}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Ticket Feedback</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
				</li>				
				@endif
								
{{-- 				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>more..</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="zmdi zmdi-smartphone-setup mr-20"></i><span class="right-nav-text">Masters</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
						<li>
							<a href="panels-wells.html">Regions</a>
						</li>
						<li>
							<a href="modals.html">State</a>
						</li>
						<li>
							<a href="sweetalert.html">City</a>
						</li>
						<li>
							<a href="notifications.html">Map Code</a>
						</li>
						<li>
							<a href="typography.html">Location Code</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#setting"><div class="pull-left"><i class="zmdi zmdi-settings mr-20"></i><span class="right-nav-text">Settings</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="setting" class="collapse collapse-level-1 two-col-list">
						<li>
							<a href="javascript:void(0);" data-toggle="collapse" data-target="#user_management"><div class="pull-left"><span class="right-nav-text">User Management</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
							<ul id="user_management" class="collapse collapse-level-1 two-col-list">
								<li>
									<a href="{{URL::to('/users')}}">Users</a>
								</li>
								<li>
									<a href="{{URL::to('/roles')}}">Roles</a>
								</li>
								<li>
									<a href="panels-wells.html">Login history</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:void(0);" data-toggle="collapse" data-target="#module_management"><div class="pull-left"><span class="right-nav-text">Module Mgmt.</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
							<ul id="module_management" class="collapse collapse-level-1 two-col-list">
								<li>
									<a href="{{URL::to('/modules')}}">modules</a>
								</li>
							</ul>
						</li>
					</ul>
				</li> --}}
				
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->	