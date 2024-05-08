@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')
{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Tbooke Learning Resources <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-bs-target="#addResourceModal" style="background-color: maroon"><i class="fas fa-plus"></i>Add  Resource</button>
                <button class="btn btn-lg btn-primary" onclick="showComingSoon()" style="background-color:maroon; border-color: #008080;">Edit</a>  
        </h1>
        </div>
<!-- Add Resource Modal -->
<div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-dark" style="background-color: #008080">
                <h4 class="modal-title" id="addResourceModalLabel">Add Tbooke Learning Resource</h4>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(request()->query('success'))
                <div class="alert alert-success" role="alert">
                    Success! Resource added successfully.
                </div>
                @endif
                <div class="text-center mb-4">
                    <img src="/images/tbooke-logo.png" alt="Tbooke Logo" class="img-fluid" style="max-height: 100px;">
                    <p class="mt-3">The ultimate community for education professionals, institutions, and learners to connect, share, and grow together with content that's educational and entertaining.</p>
                </div>
                <form id="addResourceForm" action="{{ route('save-resource') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="resourceInstitution" class="form-label">Institution Name</label>
                        <input type="text" class="form-control rounded" id="resourceInstitution" name="institution" placeholder="Enter institution name">
                    </div>
                    <!-- Pricing and Discount -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="resourcePrice" class="form-label">Price</label>
                                <input type="number" class="form-control rounded" id="resourcePrice" name="price" placeholder="Enter price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="resourceDiscount" class="form-label">Discount (%)</label>
                                <input type="number" class="form-control rounded" id="resourceDiscount" name="discount" placeholder="Enter discount">
                            </div>
                        </div>
                    </div>
                    <!-- End Pricing and Discount -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="resourceCategory" class="form-label">Category</label>
                                <select class="form-select rounded" id="resourceCategory" name="category">
                                    <option selected disabled>Select category</option>
                                    <option value="cbc">CBC CONTENTS</option>
                                    <option value="jss">JSS CONTENTS</option>
                                    <option value="high_school">HIGH SCHOOL CONTENTS</option>
                                    <option value="revision">REVISION CONTENTS</option>
                                    <option value="igcse">IGCSE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="resourceSubject" class="form-label">Subject</label>
                                <input type="text" class="form-control rounded" id="resourceSubject" name="subject" placeholder="Enter subject">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="resourceGrade" class="form-label">Grade/Form</label>
                                <input type="text" class="form-control rounded" id="resourceGrade" name="grade" placeholder="Enter grade/form">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="resourceName" class="form-label">Resource Name</label>
                                <input type="text" class="form-control rounded" id="resourceName" name="name" placeholder="Enter resource name">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="resourceLink" class="form-label">Contact Seller</label>
                        <input type="text" class="form-control rounded" id="resourceLink" name="phone" placeholder="Enter phone number">
                    </div>
                    <div class="mb-3">
                        <label for="resourceFile" class="form-label">Upload File</label>
                        <input class="form-control rounded" type="file" id="resourceFile" name="file">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Access Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="accessType" id="premium" value="premium">
                                    <label class="form-check-label" for="premium">Premium</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="accessType" id="free" value="free">
                                    <label class="form-check-label" for="free">Free</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Visibility</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" id="public" value="public">
                                    <label class="form-check-label" for="public">Public</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="visibility" id="private" value="private">
                                    <label class="form-check-label" for="private">Private</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Briefly Describe Your Resource</label>
                        <textarea type="text" name="about" placeholder="Detailed Description" class="form-control rounded" id="about" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-primary" data-bs-dismiss="modal" style="background-color: maroon">Close</button>
                        <button type="submit" class="btn btn-lg btn-primary" id="saveResourceBtn" style="background-color: maroon">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Add an event listener for form submission
    document.getElementById('addResourceForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Fetch the form data
        var formData = new FormData(this);
        // Send a POST request to the server
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            // Check if the operation was successful
            if (data.success) {
                // Display success message using SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Resource added successfully.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the specified page
                        window.location.href = "/learning-resources";
                    }
                });
            } else {
                // Display error message using SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while processing your request.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            // Display error message using SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while processing your request.',
                confirmButtonText: 'OK'
            });
        });
    });
</script>

<div class="container">
    <div class="row">
        @foreach($resources as $resource)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg rounded">
                <div class="card-img-container" style="height: 300px; overflow: hidden; position: relative;">
                    @if($resource->file)
                        @php
                        $extension = pathinfo($resource->file, PATHINFO_EXTENSION);
                        @endphp
                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <img src="{{ asset('uploads/' . $resource->file) }}" class="card-img-top rounded-top" style="object-fit: cover; width: 100%; height: auto; border-radius: 20px; position: absolute" alt="{{ $resource->name }}">
                        @elseif(in_array($extension, ['pdf', 'docx', 'xlsx', 'pptx', 'txt']))
                            <iframe class="card-img-top" src="{{ asset('uploads/' . $resource->file) }}"></iframe>
                        @elseif(in_array($extension, ['mp4', 'avi', 'mov', 'wmv', 'flv']))
                            <video class="card-img-top" controls style="object-fit: cover; width: 100%; height: auto; border-radius: 20px; position: absolute">
                                <source src="{{ asset('uploads/' . $resource->file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $resource->name }}</h5>
                    <p class="card-text text-muted"><strong>Institution:</strong> {{ $resource->institution }}</p>
                    <p class="card-text text-muted"><strong>Category:</strong> {{ $resource->category }}</p>
                    <p class="card-text text-muted"><strong>Subject:</strong> {{ $resource->subject }}</p>
                    <p class="card-text text-muted"><strong>Grade/Form:</strong> {{ $resource->grade }}</p>
                    <p class="card-text text-muted"><strong>Contact Seller:</strong> {{ $resource->phone }}</p>
                    <p class="card-text text-muted"><strong>Description of the resource:</strong> {{ $resource->about }}</p>
                    <p class="card-text text-danger rounded p-2 mb-3"><strong>Access Type:</strong> {{ $resource->access_type }}</p>
                           <!-- Pricing and Discount -->
                           @if($resource->price)
                           <p class="card-text text-danger"><strong>Price:</strong> ${{ $resource->price }}</p>
                       @endif
                       @if($resource->discount)
                           <p class="card-text text-danger"><strong>Discount:</strong> {{ $resource->discount }}%</p>
                       @endif
                       <!-- End Pricing and Discount -->

                    <!-- Add icons for like, comment, and share -->
                    <div class="row">
                        <div class="col-4 rounded-pill btn btn-light mb-2">
                            <a href="#" onclick="showComingSoon()">
                                <i class="fas fa-thumbs-up" style="font-size: 18px;color: #008080"></i> <!-- Like icon -->
                            </a>
                        </div>
                        <div class="col-4 rounded-pill btn btn-light mb-2">
                            <a href="#" onclick="showComingSoon()">
                                <i class="fas fa-comment" style="font-size: 18px;color: #008080"></i> <!-- Comment icon -->
                            </a>
                        </div>
                        <div class="col-4 rounded-pill btn btn-light mb-2">
                            <a href="#" onclick="showComingSoon()">
                                <i class="fas fa-share" style="font-size: 18px;color: #008080"></i> <!-- Share icon -->
                            </a>
                        </div>
                    </div>
                    <br>
                    <a href="#" class="btn btn-lg btn-warning w-100 mb-2" onclick="showComingSoon()" style="background-color: maroon; border-color: #008080;">Shop Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    function showComingSoon() {
        Swal.fire({
            icon: 'info',
            title: 'Coming Soon!',
            text: 'This feature will be available soon. Stay tuned!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
</script>
</main>
{{-- footer --}}
@include('includes.footer')
</div>