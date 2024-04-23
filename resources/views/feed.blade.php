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
						  <div class="col-md-6 justify-content-between align-items-center">
						  					@if ($user->profile_picture)
												<img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" alt="Profile Picture" class="avatar img-fluid rounded-circle me-2">
											@else
												<img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" alt="Profile Picture" class="avatar img-fluid rounded-circle me-2">
											@endif
								<button type="button" class="btn btn-secondary timeline-create-post" data-bs-toggle="modal" data-bs-target="#createPost">Write something interesting</button>
						  </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-xl-12">
						   <div class="card" id="activityFeed">
								<div class="card-body h-100">
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
															<div class="mb-3">
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
					const commentStoreRoute = "{{ route('comment.store') }}";
				</script>
	  	{{-- footer --}}			
	  	@include('includes.footer')
	</div>
