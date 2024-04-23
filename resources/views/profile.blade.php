@include('includes.header')
	{{-- Sidebar --}}
	@include('includes.sidebar')
		<div class="main">
			{{-- Topbar --}}
        	@include('includes.topbar')
				{{-- Main Content --}}
				<main class="content">
						<!-- Success Modal -->
						<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true"  data-bs-keyboard="true">
							<div class="modal-dialog modal-sm modal-dialog-centered position-absolute end-0">
								<div class="modal-content bg-white">
									<div class="modal-header border-0">
										<h5 class="modal-title text-success" id="successModalLabel">
											Post created successfully
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
								</div>
							</div>
						</div>
						
				<div class="container-fluid p-0">

					<div class="mb-3">
					    <div class="row mb-3">
						  <div class="col-md-12 d-flex justify-content-between align-items-center">
						  		<h1 class="h3 d-inline align-middle">Profile</h1>
								<a href="{{route('profile.edit')}}" class="btn btn-primary">Edit Profile</a>
						  </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5 col-xl-5">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Details</h5>
								</div>
								<div class="card-body text-center">
										@if ($user->profile_picture)
											<img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" alt="Profile Picture" class="img-fluid rounded-circle mb-2" width="128" height="128">
										@else
											<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" alt="Profile Picture" class="img-fluid rounded-circle mb-2" width="128" height="128">
										@endif
									<h5 class="card-title mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->surname }}</h5>
									<div class="text-muted mb-2 capitalize">{{ Auth::user()->profile_type }}</div>

									<div>
										<a class="btn btn-primary btn-sm" href="#">Follow</a>
										<a class="btn btn-primary btn-sm" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> Message</a>
									</div>
								</div>
                                	<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">About Me</h5>
                                     @if ($profileDetails && $profileDetails->about)
											<p>{{ $profileDetails->about }}</p>
											@else
											<p>You haven't added about you.</p>
									@endif
								</div>
								<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">My Subjects</h5>
										<div class="subject-links">
											@if ($profileDetails && $profileDetails->user_subjects)
												@foreach (explode(',', $profileDetails->user_subjects) as $subject)
													<a href="#" class="badge bg-primary me-1 my-1">{{ $subject }}</a>
												@endforeach
											@else
												<p>You haven't added any subjects.</p>
											@endif
										</div>
								</div>
                                	<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">Favorites Topics</h5>
										<div class="favorite-topic-links">
											@if ($profileDetails && $profileDetails->favorite_topics)
												@foreach (explode(',', $profileDetails->favorite_topics) as $topic)
													<a href="#" class="badge bg-primary me-1 my-1">{{ $topic }}</a>
												@endforeach
											@else
												<p>You haven't added any favorite topics.</p>
											@endif
										</div>
								</div>
								<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">Find me on</h5>
									<ul class="list-unstyled mb-0">
										@if ($profileDetails->socials)
											@foreach ($profileDetails->socials as $platform => $link)
												<li class="mb-1"><a target="_blank" href="{{ $link }}">{{ ucfirst($platform) }}</a></li>
											@endforeach
										@else
											<li class="mb-1">No social media profiles found.</li>
										@endif
									</ul>
								</div>
							</div>
						</div>

						<div class="col-md-7 col-xl-7">
						   
						   <div class="card" id="activityFeed">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h5 class="card-title mb-0">Activities</h5>
									<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#createPost">Create Post</button>
								</div>
								<div class="card-body h-100">
									@foreach ($posts as $post)
										<div class="d-flex align-items-start">
											@if ($user->profile_picture)
												<img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle me-2" width="36" height="36">
											@else
												<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="rounded-circle me-2" width="36" height="36">
											@endif
											<div class="flex-grow-1">
												<small class="float-end text-navy">{{ $post->created_at->diffForHumans() }}</small>
												<strong>{{ $post->user->name }}</strong><br>
												<p>{{ $post->content }}</p>
												<a href="#" class="btn btn-sm btn-secondary mt-1"><i class="feather-sm" data-feather="heart"></i> Like</a> 
												<a href="#" class="btn btn-sm btn-secondary mt-1"><i class="feather-sm" data-feather="message-square"></i> Comment</a>
												<a href="#" class="btn btn-sm btn-secondary mt-1"><i class="feather-sm" data-feather="share"></i> Share</a>
												<br>
												<small class="text-muted">{{ $post->created_at->format('M d, Y h:i A') }}</small>
												<hr>
											</div>
										</div>
									@endforeach
								</div>
							</div>
									<!-- Modal -->
										<div class="modal fade" id="createPost" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="createPostLabel">Create Post</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<form id="createPostForm">
															@csrf
															<div class="mb-3">
																<label for="postContent" class="form-label">Post Content</label>
																<textarea class="form-control" id="postContent" name="content" rows="7" placeholder="Enter your post content"></textarea>
															</div>
														</form>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary" id="submitPostBtn">Create</button>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
					</div>
			</main>
				<script>
					const postStoreRoute = "{{ route('posts.store') }}";
				</script>
	  	{{-- footer --}}			
	  	@include('includes.footer')
	</div>
