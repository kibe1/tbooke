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

					<!-- Success Modal after sharing post-->
					<div class="modal fade" id="successModalonShare" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="false">
						<div class="modal-dialog modal-sm modal-dialog-centered position-absolute end-0">
							<div class="modal-content modal-content-success">
								<div class="modal-header">
									<h5 class="modal-title" id="successModalLabel">
										Repost successful
									</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
							</div>
						</div>
					</div>


				<div class="container-fluid p-0">
				
					<div class="mb-3">
						<div class="row mb-3">
							<div class="col-md-6 d-flex justify-content-start align-items-center">
								<h1 class="h3 d-inline align-middle">Profile</h1>
								<a href="{{ route('profile.edit') }}" class="btn btn-primary ms-2">Edit Profile</a>
							</div>

							<div class="col-md-6 tbooke-creator-btn-application">
								@if ($userIsCreator)
									<button type="button" class="btn btn-tbooke mb-2 mb-md-0 me-md-2 tbooke-creator-btn">Tbooke Creator</button>
								@elseif($user->profile_type !== 'student' && $user->profile_type !== 'institution' && $user->profile_type !== 'other')
									<button type="button" class="btn btn-tbooke mb-2 mb-md-0 me-md-2" data-bs-toggle="modal" data-bs-target="#creatorMode">Become a Tbooke Creator</button>
								@endif
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
									<div class="mb-3 d-inline-flex card-title text-center">
										<p class="me-2">Connections: {{ $followersCount }}</p>
									</div>
								</div>
                                	<hr class="my-0">
								<div class="card-body ml-3">
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
								</div>
								<div class="card-body h-100">
									@if ($posts->isEmpty())
        							 <p>You do not have any activities.</p>
									@else
									@foreach ($posts as $post)
											<div class="d-flex align-items-start post-box" id="post-{{ $post->id }}">
											@if ($post->user->id == $user->id)
											<a href="{{ route('profile.showOwn') }}" class="user-image">
												@if ($post->user->profile_picture)
													<img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
												@else
													<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
												@endif
											</a>
											@else
											<a href="{{ route('profile.show', $post->user->username) }}" class="user-image">
												@if ($post->user->profile_picture)
													<img src="{{ asset('storage/' . $post->user->profile_picture) }}" alt="Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
												@else
													<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="rounded-circle img-fluid me-2" width="36" height="36">
												@endif
											</a>
											@endif
											<div class="flex-grow-1">
												<small class="float-end text-navy">{{ $post->created_at->diffForHumans() }}</small>
												<strong>
												@if ($post->user->id == $user->id)
												<a href="{{ route('profile.showOwn') }}" class="user-name">{{ $post->user->first_name }} {{ $post->user->surname }}</a>
												@else
												<a href="{{ route('profile.show', $post->user->username) }}" class="user-name">{{ $post->user->first_name }} {{ $post->user->surname }}</a>
												@endif
												</strong><br>
												<p>{{ $post->content }}</p>
												<span id="likes-count-{{ $post->id }}"><i class="feather-sm" data-feather="thumbs-up"></i> {{ $post->likes->count() }}</span> <br>

												@if($post->likes->contains('id', auth()->user()->id))
													<form id="unlikeForm-{{ $post->id }}" action="{{ route('post.unlike', $post->id) }}" method="POST" class="like-unlike-form" data-post-id="{{ $post->id }}" data-action-like="{{ route('post.like', $post->id) }}" data-action-unlike="{{ route('post.unlike', $post->id) }}">
														@csrf
														<button type="submit" id="unlikeButton-{{ $post->id }}" class="btn btn-sm btn-secondary rounded mt-1 engage-btns unlike-btn engage-unlike-btn">
															<span class="d-none d-md-inline"><i class="feather-sm" data-feather="thumbs-down"></i> Unlike</span>
															<span class="d-inline d-md-none"><i class="feather-sm" data-feather="thumbs-down"></i></span>
														</button>
													</form>
												@else
													<form id="likeForm-{{ $post->id }}" action="{{ route('post.like', $post->id) }}" method="POST" class="like-unlike-form" data-post-id="{{ $post->id }}" data-action-like="{{ route('post.like', $post->id) }}" data-action-unlike="{{ route('post.unlike', $post->id) }}">
														@csrf
														<button type="submit" id="likeButton-{{ $post->id }}" class="btn btn-sm btn-secondary rounded mt-1 engage-btns like-btn">
															<span class="d-none d-md-inline"><i class="feather-sm" data-feather="thumbs-up"></i> Like</span>
															<span class="d-inline d-md-none"><i class="feather-sm" data-feather="thumbs-up"></i></span>
														</button>
													</form>
												@endif

												<a class="btn btn-sm btn-secondary mt-1  rounded comment-toggle-btn engage-btns"><span class="d-none d-md-inline"><i class="feather-sm" data-feather="message-square"></i> Comment</span><span class="d-inline d-md-none"><i class="feather-sm" data-feather="message-square"></i></span></a>
												
														<form id="reshare-{{ $post->id }}" action="{{ route('post.share', $post->id) }}" method="POST" class="share-form" data-post-id="{{ $post->id }}">
															@csrf
															<button type="submit" id="shareButton-{{ $post->id }}" class="btn btn-sm btn-secondary rounded mt-1 engage-btns like-btn">
																<span class="d-none d-md-inline"><i class="feather-sm" data-feather="repeat"></i> Repost</span>
																<span class="d-inline d-md-none"><i class="feather-sm" data-feather="repeat"></i></span>
															</button>
														</form>
														
													<div class="comment-stats float-end">
														 @if ($post->comments->count() > 0)
															<a class="text-muted comment-toggle-btn comment-count" href="#">{{ $post->comments->count() }} {{ $post->comments->count() > 1 ? 'Comments' : 'Comment' }}</a>
														@endif
														@if ($post->reshare_count > 0)
															<a class="text-muted reshare-count" id="reshare-count-{{ $post->id }}" href="#">{{ $post->reshare_count }} {{ $post->reshare_count > 1 ? 'Reposts' : 'Repost' }}</a>
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
									<!-- Create Post Modal -->
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

										<!-- Become a creator -->
										<div class="modal fade" id="creatorMode" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="">Become a Creator</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<form id="creatorModeForm">
															@csrf
															<div class="mb-3">
          														<select data-placeholder="Which subjects do you consider yoursel an expert?" name="creator_subjects[]" multiple class="chosen-select-width form-select" tabindex="16">
																	<option value="Geography">Geography</option>
																	<option value="Mathemathics">Mathemathics</option>
																	<option value="English">English</option>
																	<option value="Kiswahili">Kiswahili</option>
																	<option value="Business">Business</option>
																</select>
																{{-- <input class="form-control" type="text" name="creator_subjects" value="" placeholder="Which subjects do you consider yoursel an expert?"> --}}
															</div>
															<div class="mb-3">
          														<select data-placeholder="Which learning grades will be your main target?" name="creator_expertise[]" multiple class="chosen-select-width form-select" tabindex="16">
																	<option value="pre_school">Pre School</option>
																	<option value="grade_1_6">Grades 1-6</option>
																	<option value="cbc_content">CBC Content</option>
																	<option value="jss">Junior Secondary School</option>
																	<option value="high_school">High School</option>
																</select>
															</div>
															<div class="mb-3">
																<textarea class="form-control"  name="the_why" rows="7" placeholder="Why do you want to become a Tbooke creator"></textarea>
															</div>
														</form>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary" id="submitRequestBtn">Submit</button>
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
					const commentStoreRoute = "{{ route('comment.store') }}";
					const creatorApplicationRoute = "{{ route('creator.store') }}";
				</script>
	  	{{-- footer --}}
	  	@include('includes.footer')
	</div>

