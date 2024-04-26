<!-- Header -->
@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Tbooke Learning</h1>
        </div>
        <div class="container-fluid">
            <a class="dashboard-cards-a -mt-0" href="" id="show-form" >
                <div class="card bg-info text-black mb-1 rounded-0">
                    <div class="card-header">
                        <h3 class="card-title text-black text-center mb-0">Create Contents</h3>
                    </div>
                </div>
            </a>
        </div>


        <div class="container-fluid">
               <h1>Resources Goes Here!!!</h1>
               <div class="row">
                <div class="col-md-3">
                    <a class="dashboard-cards-a" href="#">
                        <div class="card">
                            <div class="card-header learning">
                                <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                <p>Latest Material added</p>
                          
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="dashboard-cards-a" href="#">
                        <div class="card">
                            <div class="card-header learning">
                                <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                <p>Latest Material added</p>
                          
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="dashboard-cards-a" href="#">
                        <div class="card">
                            <div class="card-header learning">
                                <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                <p>Latest Material added</p>
                          
                        </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="dashboard-cards-a" href="">
                    <div class="card">
                        <div class="card-header resources">
                            <h5 class="card-title mb-3 card-title-dashboard"></h5>
                            <p>KCSE Revision Materials</p>
                           
                        </div>
                    </div>
                </a>
                </div>
               
        

                <div class="container-fluid">
                    <div class="row">
                     <div class="col-md-3">
                         <a class="dashboard-cards-a" href="#">
                             <div class="card">
                                 <div class="card-header learning">
                                     <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                     <p>Latest Material added</p>
                               
                             </div>
                             </div>
                         </a>
                     </div>
                     <div class="col-md-3">
                         <a class="dashboard-cards-a" href="#">
                             <div class="card">
                                 <div class="card-header learning">
                                     <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                     <p>Latest Material added</p>
                               
                             </div>
                             </div>
                         </a>
                     </div>
                     <div class="col-md-3">
                         <a class="dashboard-cards-a" href="#">
                             <div class="card">
                                 <div class="card-header learning">
                                     <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                     <p>Latest Material added</p>
                               
                             </div>
                             </div>
                         </a>
                     </div>
                     <div class="col-md-3">
                         <a class="dashboard-cards-a" href="">
                         <div class="card">
                             <div class="card-header resources">
                                 <h5 class="card-title mb-3 card-title-dashboard"></h5>
                                 <p>KCSE Revision Materials</p>
                                
                             </div>
                         </div>
                     </a>
                     </div>
                    
     </div>

    </main>
    {{-- footer --}}
    @include('includes.footer')
</div>
<!-- Form Container -->
<div id="form-container" class="container" style="display: none; position: fixed; top: 40%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; width: 70%;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-0">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class='text-white justify-content-center'>{{ __('Create Content') }}</h5>
                    <button type="button" class="btn-close btn btn-sm btn-light" aria-label="Close form" id="close-form">&times;</button>
                </div>
                <div class="card-body">
                    <form  action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Resource Type') }}</label>
                            <div class="col-md-8">
                                <input id="type" type="text" class="form-control @error('type') is-invalid @enderror rounded-0" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                            <div class="col-md-8">
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror rounded-0" name="content" required autocomplete="content">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group row">
                            <label for="files" class="col-md-4 col-form-label text-md-right">{{ __('Files') }}</label>
                            <div class="col-md-8">
                                <input id="files" type="file" class="form-control-file @error('files') is-invalid @enderror" name="files[]" multiple onchange="previewFiles(this)">
                                <div id="file-preview"></div> <!-- Display file previews here -->
                                @error('files')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('Activate') }}</label>
                            <div class="col-md-8">
                                <input id="active" type="checkbox" class="@error('active') is-invalid @enderror" name="active" {{ old('active') ? 'checked' : '' }}>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary rounded-0">
                                    {{ __('Create Content') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('show-form').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('form-container').style.display = 'block';
        });
        document.getElementById('close-form').addEventListener('click', function() {
            document.getElementById('form-container').style.display = 'none';
        });
    });
    function previewFiles(input) {
        var preview = document.getElementById('file-preview');
        preview.innerHTML = '';
        if (input.files) {
            var filesAmount = input.files.length;
            for (var i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                var file = input.files[i];
                reader.onload = function(event) {
                    var div = document.createElement('div');
                    div.classList.add('preview-item');
                    if (file.type.startsWith('image')) {
                        div.innerHTML = '<img src="' + event.target.result + '" class="img-fluid mb-2" style="max-width: 100%; max-height: 200px;">';
                    } else if (file.type.startsWith('video')) {
                        div.innerHTML = '<video controls><source src="' + event.target.result + '"></video>';
                    } else if (file.type == 'application/pdf') {
                        div.innerHTML = '<embed src="' + event.target.result + '" type="application/pdf" class="pdf-preview">';
                    } else {
                        div.innerHTML = '<span>' + file.name + '</span>';
                    }
                    preview.appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        }
    }
</script>
