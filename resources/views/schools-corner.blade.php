@include('includes.header')

{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">Our Schools Corner</h1>
                <div class="post-container" onclick="openPopup()"> 
                    <input type="text" class="post-input rounded-pill"
                     placeholder="Post about your school" readonly>
                </div>
            </div>
        </div>
        
        <div id="postPopup" class="popup">
            <div class="popup-header">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#">
                    @if ($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="avatar img-fluid rounded me-1">
                    @else
                        <img src="{{ asset('/default-images/avatar.png') }}" alt="Default Profile Picture" class="avatar img-fluid rounded me-1">
                    @endif
                    {{ Auth::user()->first_name }} {{ Auth::user()->surname }}
                </a>
                <span class="popup-close" onclick="closePopup()">&times;</span>
            </div>
            <form method="POST" action="{{ route('save.school.post') }}" enctype="multipart/form-data">
                @csrf
                <textarea name="description" class="popup-input" placeholder="What do you want to talk about your school?"></textarea>
                <div class="preview-section" id="previewSection"></div>
                <div class="popup-options">
                    <button type="button" onclick="triggerFileInput('photoInput')">
                        <i class="fas fa-image"></i> Photos
                    </button>
                    <button type="button" onclick="triggerFileInput('videoInput')">
                        <i class="fas fa-video"></i> Video
                    </button>
                    <button type="button" onclick="triggerFileInput('documentInput')">
                        <i class="fas fa-file-alt"></i> Document
                    </button>
                    <button type="submit" id="postButton">Add Your School</button>
                </div>
                <input type="file" name="photo" id="photoInput" style="display:none" accept="image/*" onchange="previewFile('photoInput')">
                <input type="file" name="video" id="videoInput" style="display:none" accept="video/*" onchange="previewFile('videoInput')">
                <input type="file" name="document" id="documentInput" style="display:none" accept=".pdf,.doc,.docx,.txt" onchange="previewFile('documentInput')">
            </form>
            
        </div>

   <!-- Display saved school posts -->
<div class="row">
    @foreach($schoolPosts as $schoolPost)
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $schoolPost->description }}</h5>
                <!-- Display photo if available -->
                @if($schoolPost->photo)
                <img src="{{ asset('uploads/' . $schoolPost->photo) }}" alt="School Post Photo">
                @endif
                <!-- Display video if available -->
                @if($schoolPost->video)
                <video controls>
                    <source src="{{ asset('storage/' . $schoolPost->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endif
                <!-- Display document if available -->
                @if($schoolPost->document)
                <a href="{{ asset('storage/' . $schoolPost->document) }}" target="_blank">View Document</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- End of display saved school posts -->


    </main>


    
    <style>
        .preview-section img, .preview-section video, .preview-section .document-preview {
    max-width: 100%; /* Change this to adjust the maximum width */
    max-height: 200px; /* Add this line to limit the height */
    margin-bottom: 10px;
}

.document-preview {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    max-width: 100%;
    max-height: 200px;
}

        .h3 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #008080;
    }

    .post-container {
        cursor: pointer;
    }

    .post-input {
        border: none;
        box-shadow: none;
        outline: none;
        font-size: 16px;
        padding: 10px 20px;
        background-color: maroon;
        border-radius: 30px;
        transition: background-color 0.3s;
        cursor: pointer; /* Added */
    }

    .post-input:read-only {
        cursor: pointer;
    }

    .post-input::placeholder {
        color: #fff;
    }

    .post-input:hover {
        background-color: #008080;
    }


        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            z-index: 10;
            width: 80%;
            max-width: 600px;
        }
            .post-creator-wrapper {
                padding: 20px;
            }

   
            .post-container:hover {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .post-input {
                flex-grow: 1;
                border: none;
                outline: none;
                font-size: 16px;
            }

            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                padding: 30px;
                z-index: 10;
                width: 80%;
                max-width: 600px;
            }

            .popup-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .popup-close {
                cursor: pointer;
                font-size: 30px;
            }

            .popup-input {
                width: 100%;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 16px;
                resize: vertical;
                height: 200px;
            }

            .preview-section {
                margin-bottom: 20px;
            }

            .preview-section img, .preview-section video, .preview-section .document-preview {
                max-width: 100%;
                margin-bottom: 10px;
            }

            .document-preview {
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 5px;
            }

            .popup-options {
                display: flex;
                justify-content: space-around;
                border-top: 1px solid #ddd;
                padding-top: 20px;
            }

            .popup-options button {
                background: none;
                border: none;
                cursor: pointer;
                padding: 15px 20px;
                font-size: 16px;
                display: flex;
                align-items: center;
                transition: color 0.3s, transform 0.3s;
            }

            .popup-options button:hover {
                color: #007BFF;
                transform: scale(1.1);
            }

            .popup-options button img {
                width: 25px;
                height: 25px;
                margin-right: 10px;
            }
        </style>
        <script>
            function openPopup() {
                document.getElementById("postPopup").style.display = "block";
            }

            function closePopup() {
                document.getElementById("postPopup").style.display = "none";
            }

            function triggerFileInput(inputId) {
                document.getElementById(inputId).click();
            }

            function previewFile(inputId) {
                const fileInput = document.getElementById(inputId);
                const previewSection = document.getElementById("previewSection");
                const file = fileInput.files[0];
                const reader = new FileReader();

                if (file) {
                    reader.onload = function (e) {
                        let previewElement;

                        if (inputId === 'photoInput') {
                            previewElement = document.createElement('img');
                            previewElement.src = e.target.result;
                        } else if (inputId === 'videoInput') {
                            previewElement = document.createElement('video');
                            previewElement.src = e.target.result;
                            previewElement.controls = true;
                        } else if (inputId === 'documentInput') {
                            previewElement = document.createElement('div');
                            previewElement.className = 'document-preview';
                            previewElement.innerText = file.name;
                        }

                        previewSection.innerHTML = '';
                        previewSection.appendChild(previewElement);
                    }

                    reader.readAsDataURL(file);
                }
            }
        </script>
    {{-- Footer --}}
    @include('includes.footer')
</div>
