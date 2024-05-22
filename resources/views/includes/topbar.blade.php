

<nav class="navbar navbar-expand bg-body-tertiary">
		<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						 <li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">{{ $notificationCount }}</span>
								</div>
							</a>
{{--
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
								 Notifications
								</div>
								<div class="list-group">
								@if ($notificationCount > 0)
									@foreach ($notifications as $notification)
										<span class="list-group-item">
											<div class="row g-0 align-items-center">
												<div class="col-2">
													<i class="text-success" data-feather="user-plus"></i>
												</div>
												<div class="col-10">
													<div class="text-dark type">{{ $notification->type }}</div>
													<div class="text-muted small mt-1"><a href="{{ route('profile.show', [$notification->sender->username]) }}">{{ $notification->follower_name }}</a> {{ $notification->message }}</div>
													<div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>
												</div>
											</div>
										</span>
									@endforeach
								@else
									<p class="ml-20">You do not have new notifications.</p>
								@endif
								</div>
								{{-- <div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div> --}}
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                				<i class="align-middle" data-feather="settings"></i>
              				</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                							@if (Auth::user()->profile_picture)
												<img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" alt="Profile Picture" class="avatar img-fluid rounded me-1">
											@else
												<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" alt="Profile Picture" class="avatar img-fluid rounded me-1">
											@endif
								<span class="text-dark">{{ Auth::user()->first_name }} {{ Auth::user()->surname }}</span>
              				</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{route('profile.showOwn')}}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Resources</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<form method="POST" action="{{ route('logout') }}">
                    				@csrf

                    				<x-responsive-nav-link :href="route('logout')"
                            		onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        			{{ __('Log Out') }}
                    				</x-responsive-nav-link>
                				</form>
							</div>
						</li>
					</ul>
				</div>
			</nav>