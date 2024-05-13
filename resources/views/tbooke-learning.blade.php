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

					<div>
						<div class="row content">
							<div class="col-md-6 d-flex justify-content-start align-items-center">
								<h1 class="h3 d-inline align-middle">Tbooke Learning</h1>
							</div>
						@if ($userIsCreator)
							<div class="col-md-6">
								<div class="d-md-none text-start mb-md-0">
									<a href="{{ route('tbooke-learning.create') }}" class="btn btn-tbooke tbooke-create-btn">Create</a>
								</div>
								<div class="d-none d-md-block">
									<div class="text-end">
										<a href="{{ route('tbooke-learning.create') }}" class="btn btn-tbooke mb-2 mb-md-0 me-md-2 tbooke-create-btn">Create</a>
									</div>
								</div>
							</div>
						@endif
						</div>
					</div>

						<div class="row content">
							@foreach($contents as $content)
								<div class="col-12 col-md-4">
									<div class="card">
										<a href="{{ route('content.show', $content->slug) }}"><img class="card-img-top content-thumbnail" src="{{ asset('storage/' . $content->content_thumbnail) }}" alt=""></a>
										<div class="card-header author-category">
											<h5 class="card-title author">{{ $content->user->first_name }} {{ $content->user->surname }}</h5>
											<a href="{{ route('content.show', $content->slug) }}" class="content-title"><h5 class="card-title content-title">{{ $content->content_title }}</h5></a>
											<div class="content-categories">
												@foreach(explode(',', $content->content_category) as $category)
													<a href="#" class="badge bg-primary me-1 my-1">{{ $category }}</a>
												@endforeach
											</div>
											<div class="content-stats">
												<a href="#" class="card-link stat-link"><i class="feather-sm content-stats-icon" data-feather="clock"></i>  <span class="content-stats-span">2-3 hours</span></a>
												<a href="#" class="card-link stat-link"><i class="feather-sm content-stats-icon" data-feather="user-check"></i>  <span class="content-stats-span">250 learners</span></a>
											</div>
										</div>
										<div class="card-body tbooke-content">
											<p class="card-text content-desc">{{ Str::limit(strip_tags($content->content), 52) }}</p>
											<a href="{{ route('content.show', $content->slug) }}" class="card-link start-learning-button">Start Learning</a>
										</div>
									</div>
								</div>
							@endforeach
						</div>

		</div>
    </main>
    {{-- footer --}}
    @include('includes.footer')
</div>
