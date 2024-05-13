@include('includes.header')
    {{-- Sidebar --}}
	@include('includes.sidebar')
	@include('sweetalert::alert')
	
	{{-- Topbar --}}
	<div class="main">
        @include('includes.topbar')
			{{-- Main Content --}}
			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">Edit Profile</h1>

					<div class="row">
					
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-body text-center">
									<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profile_form" >
									@csrf
									@method('post')
											@if ($user->profile_picture)
												<img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle mb-2" width="128" height="128">
											@else
												<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="img-fluid rounded-circle mb-2" width="128" height="128">
											@endif
										<!-- Profile Picture Input -->
										<div class="mb-3">
											<label for="profile_picture" class="form-label">Profile Picture</label>
											<input id="profile_picture" name="profile_picture" type="file" class="form-control mb-3">
										</div>
										<div class="row">
											<div class="col-md-6">
												<input value="{{ Auth::user()->first_name }}" name="first_name" type="text" class="form-control mb-3" />
											</div>
											<div class="col-md-6">
												<input value="{{ Auth::user()->surname }}" name="surname" type="text" class="form-control mb-3" />
											</div>
										</div>
											<div class="row">
												<div class="col-md-6">
													<input value="{{ Auth::user()->profile_type }}" type="text" class="form-control mb-3 capitalize" disabled />
												</div>
												<div class="col-md-6">
													<input value="{{ Auth::user()->email }}" name="email" type="text" class="form-control mb-2" />
												</div>
											</div>
									</div>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="h6 card-title">About Me</h5>
								</div>
								<div class="card-body">
									<textarea class="form-control" name="about" rows="4" cols="5" placeholder="Tell us more about yourself">{{ $profileDetails->about ?? '' }}</textarea>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="h6 card-title">My Subjects</h5>
								</div>
								<div class="about-card-inner">
									<select name="user_subjects[]" data-placeholder="Select your subjects" multiple class="chosen-select-width form-select" tabindex="16">
										<option value="Geography" @if(in_array('Geography', $userSubjects)) selected @endif>Geography</option>
										<option value="Mathematics" @if(in_array('Mathematics', $userSubjects)) selected @endif>Mathematics</option>
										<option value="Business" @if(in_array('Business', $userSubjects)) selected @endif>Business</option>
										<option value="Kiswahili" @if(in_array('Kiswahili', $userSubjects)) selected @endif>Kiswahili</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					
				<div class="row">
						
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="h6 card-title">Favorite Topics</h5>
								</div>
								<div class="about-card-inner">
									<select name="favorite_topics[]" data-placeholder="Select your favorite topics" multiple class="chosen-select-width form-select" tabindex="16">
											<option value="Algebra" @if(in_array('Algebra', $favoriteTopics)) selected @endif>Algebra</option>
    										<option value="Calculus" @if(in_array('Calculus', $favoriteTopics)) selected @endif>Calculus</option>
    										<option value="Marketing" @if(in_array('Marketing', $favoriteTopics)) selected @endif>Marketing</option>
    										<option value="Insurance" @if(in_array('Insurance', $favoriteTopics)) selected @endif>Insurance</option>
									</select>
								</div>
							</div>
						</div>
						
					<div class="col-md-6">
						<div style="padding-bottom: 18px;" class="card">
							<div class="card-header">
								<h5 class="h6 card-title">Social Media</h5>
							</div>
							<div class="card-body row align-items-center card-body-forms">
								<label for="facebookInput" class="col-sm-3 col-form-label">Facebook:</label>
								<div class="col-sm-9">
									<input type="text" id="facebookInput" name="socials[facebook]" class="form-control" placeholder="Enter your Facebook profile" value="{{ $profileDetails->socials['facebook'] ?? '' }}">
								</div>
							</div>
							<div class="card-body row align-items-center card-body-forms">
								<label for="twitterInput" class="col-sm-3 col-form-label">Twitter:</label>
								<div class="col-sm-9">
									<input type="text" id="twitterInput" name="socials[twitter]" class="form-control" placeholder="Enter your Twitter profile" value="{{ $profileDetails->socials['twitter'] ?? '' }}">
								</div>
							</div>
						</div>
					</div>
				</div>	
				
					<div class="row">
    					<div class="col-md-12 d-flex justify-content-end align-items-center">
        				<input type="submit" class="btn btn-primary" id="submit_form" value="Save Profile" />
    				</div>
				</div>
				</form>
			</div>
		</main>
        {{-- footer --}}
	  @include('includes.footer')
	</div>
