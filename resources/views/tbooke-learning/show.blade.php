@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
				<div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-body">
							    <div class=""><h1><h1 class="h3 mb-3">{{ $content->content_title }}</h1></div>
                                <div class="creator-content">{!! htmlspecialchars_decode($content->content) !!}</div>
                            </div>   
                        </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('storage/' . $content->content_thumbnail) }}" alt="">
                        <div class="card-header">
							<h5 class="card-title mb-0">{{ $content->content_title }}</h5>
						</div>
                        <div class="card-body">
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-primary">Explore More</a>
						</div>
                    </div>
                </div>
            </div>    
        </div>
    </main>
    {{-- footer --}}
    @include('includes.footer')
</div>
