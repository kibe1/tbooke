@include('includes.header')
	{{-- Sidebar --}}
	@include('includes.sidebar')
		<div class="main">
			{{-- Topbar --}}
        	@include('includes.topbar')
				{{-- Main Content --}}
				<main class="content">
				<div class="container-fluid p-0">
					<div class="mb-3">
						<div class="row mb-3">
							<div class="col-md-6 d-flex justify-content-start align-items-center">
								<h1 class="h3 d-inline align-middle">Profile</h1>
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
									<h5 class="card-title mb-0">{{ $user->first_name }} {{ $user->surname }}</h5>
									<div class="text-muted mb-2 capitalize">{{ Auth::user()->profile_type }}</div>

									<div class="mb-3 d-flex justify-content-center">
										@if(Auth::user()->follows($user))
										<form id="unfollowForm">
										@csrf
										<button type="submit" class="btn btn-danger btn-sm me-2" id="unfollowButton" >
											<i class="feather-sm" data-feather="user-minus"></i> Unfollow
										</button>
										</form>
										@else		
										<form id="followForm">
											@csrf
											<button type="submit" class="btn btn-primary btn-sm me-2" id="followButton" >
												<i class="feather-sm" data-feather="user-plus"></i> Follow
											</button>
										</form>
										@endif
										<form action="">
											<button class="btn btn-primary btn-sm ms-2">
												<i class="feather-sm" data-feather="message-square"></i> Message
											</button>
										</form>
									</div>


								</div>
                                	<hr class="my-0">
								<div class="card-body ml-3">
									<h5 class="h6 card-title">About</h5>
                                     @if ($profileDetails && $profileDetails->about)
											<p>{{ $profileDetails->about }}</p>
											@else
											<p>No about given.</p>
									@endif
								</div>
								<hr class="my-0">
								<div class="card-body">
									<h5 class="h6 card-title">Subjects</h5>
										<div class="subject-links">
											@if ($profileDetails && $profileDetails->user_subjects)
												@foreach (explode(',', $profileDetails->user_subjects) as $subject)
													<a href="#" class="badge bg-primary me-1 my-1">{{ $subject }}</a>
												@endforeach
											@else
												<p>No Subjects added.</p>
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
												<p>No topics added.</p>
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
								</div>
								<div class="card-body h-100">
									@if ($posts->isEmpty())
        							 <p>No activities added.</p>
									@else
										@foreach ($posts as $post)
										<div class="d-flex align-items-start post-box">
											@if ($post->user->profile_picture)
													<img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
												@else
													<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
											@endif
											<div class="flex-grow-1">
												<small class="float-end text-navy">{{ $post->created_at->diffForHumans() }}</small>
												<strong>{{ $post->user->first_name }} {{ $post->user->surname }}</strong><br>
												<p>{{ $post->content }}</p>
						
												<a href="#" class="btn btn-sm btn-secondary rounded mt-1"><span class="d-none d-md-inline"><i class="feather-sm" data-feather="heart"></i> Like</span><span class="d-inline d-md-none"><i class="feather-sm" data-feather="heart"></i></span></a>
												<a class="btn btn-sm btn-secondary mt-1  rounded comment-toggle-btn"><span class="d-none d-md-inline"><i class="feather-sm" data-feather="message-square"></i> Comment</span><span class="d-inline d-md-none"><i class="feather-sm" data-feather="message-square"></i></span></a>
												<a href="#" class="btn btn-sm btn-secondary rounded mt-1"><span class="d-none d-md-inline"><i class="feather-sm" data-feather="share"></i> Repost</span><span class="d-inline d-md-none"><i class="feather-sm" data-feather="share"></i></span></a>

													<div class="comment-stats float-end">
														 @if ($post->comments->count() > 0)
															<a class="text-muted comment-toggle-btn" href="#">{{ $post->comments->count() }} Comments</a>
														@endif
													</div>
													<br>
													<div class="card-body comment-box">
															<form id="createCommentForm{{ $post->id }}">
															@csrf
															<input type="hidden" name="post_id" value="{{ $post->id }}">
															<div class="mb-3 mt-3">
																<textarea class="form-control comment-area" name="content" id="commentContent{{ $post->id }}" rows="2" placeholder="Post your comment"></textarea>
															</div>
														</form>
														<button type="button" id="submitCommentBtn{{ $post->id }}" class="btn btn-primary submit-comment-btn">Submit</button>
														 	@foreach ($post->comments as $comment)
																<div class="comment-item d-flex align-items-start mt-1">
																	<div class="profile_image_in_comment">
																		<a class="#" href="#">
																		@if ($comment->user->profile_picture)
																			<img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="{{ $comment->user->first_name }}'s Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
																		@else
																			<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
																		@endif	
																		</a>
																	</div>
																	<div class="flex-grow-1 comment-item-inner-box">
																		<small class="float-end text-navy">{{ $comment->created_at->diffForHumans() }}</small>
																		<div class="text-muted p-2 mt-1">
																			<div><strong>{{ $comment->user->first_name }} {{ $comment->user->surname }}</strong></div>
																			<div>{{ $comment->content }}</div>
																		</div>
																	</div>
																</div>
															@endforeach
													</div>
											</div>
										</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

	<script>
		const userFollowRoute = "{{ route('users.follow', $user->id) }}";
		const userunfollowRoute = "{{ route('users.unfollow', $user->id) }}";
	</script>			
	  	{{-- footer --}}
	  	@include('includes.footer')
	</div>

