@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row justify-content-around">
				<div class="col-md-9 col-12">
                    <div class="card">
                        <div class="card-header">
							<h5 class="card-title mb-0">Create Content</h5>
						</div>
                        <div class="card-body content-creation-form">
                            <form method="POST" action="{{ route('tbooke-learning.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="content_title" placeholder="Content title">
                                </div>
                                <div class="mb-3">
                                    <select data-placeholder="Content category" name="content_category[]" multiple class="chosen-select-width form-select">
                                        <option value="Pre School">Pre School</option>
                                        <option value="Grades 1-6">Grades 1-6</option>
                                        <option value="CBC Content">CBC Content</option>
                                        <option value="JSS">Junior Secondary School</option>
                                        <option value="High School">High School</option>
                                    </select>
                                </div>
                                <div class="mb-3">
									<label for="content_thumbnail" class="form-label">Content Thumbnail</label>
									<input id="content_thumbnail" name="content_thumbnail" type="file" class="form-control mb-3">
								</div>
                                <div class="mb-3">
                                     <textarea class="form-control tinymce-textarea" name="content" placeholder="Start typing your content..." rows="10"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                </div>
                            </form>
						</div>
					</div>
                </div>
			</div>
        </div>
    </main>
    {{-- footer --}}
    @include('includes.footer')
</div>