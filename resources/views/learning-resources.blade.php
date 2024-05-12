@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Tbooke Learning Resources 
                <button class="btn btn-lg btn-primary" data-bs-toggle="modal"
                 data-bs-target="#addResourceModal" style="background-color: maroon">
                    <i class="fas fa-plus"></i> Sell On Tbooke
                </button>
            </h1>
        </div>
        <!-- Add Resource Modal -->
        <div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addResourceModalLabel">Sell On Tbooke</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(request()->query('success'))
                        <div class="alert alert-success" role="alert">
                            Success! Resource added successfully.
                        </div>
                        @endif
                        <form id="addResourceForm" action="{{ route('save-resource') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="resourceCategory" class="form-label">Category</label>
                                   
											<select class="form-select rounded" id="resourceCategory" name="category">
                                    <option selected disabled>Select category</option>
                                    <option value="CBC">CBC CONTENTS</option>
                                    <option value="JSS">JSS CONTENTS</option>
                                    <option value="School uniform">SCHOOL UNIFORM</option>
                                    <option value="Lab Equipmemt">LAB EQUIPMENT</option>
                                    <option value="Other Learning Matrials">OTHER LEARNING MATERIALS</option>
                                    <option value="High school">HIGH SCHOOL CONTENTS</option>
                                    <option value="Revision">REVISION CONTENTS</option>
                                    <option value="Igcse">IGCSE</option>
                                </select>
											
                           
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="county" class="form-label">County</label>
                                         <select class="form-select rounded" id="county" name="location">
                                    <option selected disabled>Select county</option>
                                    <option value="Baringo">Baringo</option>
                                    <option value="Bomet">Bomet</option>
                                    <option value="Bungoma">Bungoma</option>
                                    <option value="Busia">Busia</option>
                                    <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
                                    <option value="Embu">Embu</option>
                                    <option value="Garissa">Garissa</option>
                                    <option value="Homa Bay">Homa Bay</option>
                                    <option value="Isiolo">Isiolo</option>
                                    <option value="Kajiado">Kajiado</option>
                                    <option value="Kakamega">Kakamega</option>
                                    <option value="Kericho">Kericho</option>
                                    <option value="Kiambu">Kiambu</option>
                                    <option value="Kilifi">Kilifi</option>
                                    <option value="Kirinyaga">Kirinyaga</option>
                                    <option value="Kisii">Kisii</option>
                                    <option value="Kisumu">Kisumu</option>
                                    <option value="Kitui">Kitui</option>
                                    <option value="Kwale">Kwale</option>
                                    <option value="Laikipia">Laikipia</option>
                                    <option value="Lamu">Lamu</option>
                                    <option value="Machakos">Machakos</option>
                                    <option value="Makueni">Makueni</option>
                                    <option value="Mandera">Mandera</option>
                                    <option value="Marsabit">Marsabit</option>
                                    <option value="Meru">Meru</option>
                                    <option value="Migori">Migori</option>
                                    <option value="Mombasa">Mombasa</option>
                                    <option value="Murang'a">Murang'a</option>
                                    <option value="Nairobi">Nairobi</option>
                                    <option value="Nakuru">Nakuru</option>
                                    <option value="Nandi">Nandi</option>
                                    <option value="Narok">Narok</option>
                                    <option value="Nyamira">Nyamira</option>
                                    <option value="Nyandarua">Nyandarua</option>
                                    <option value="Nyeri">Nyeri</option>
                                    <option value="Samburu">Samburu</option>
                                    <option value="Siaya">Siaya</option>
                                    <option value="Taita Taveta">Taita Taveta</option>
                                    <option value="Tana River">Tana River</option>
                                    <option value="Tharaka Nithi">Tharaka Nithi</option>
                                    <option value="Trans Nzoia">Trans Nzoia</option>
                                    <option value="Turkana">Turkana</option>
                                    <option value="Uasin Gishu">Uasin Gishu</option>
                                    <option value="Vihiga">Vihiga</option>
                                    <option value="Wajir">Wajir</option>
                                    <option value="West Pokot">West Pokot</option>
                                </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="resourceFile" class="form-label">Add Photo</label>
                                <input class="form-control rounded" type="file" id="resourceFile" name="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea type="text" name="about" placeholder="Description including contacts.." class="form-control rounded" id="about" cols="30" rows="10"></textarea>
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
        <style>
            .image-container {
                height: 200px; /* Adjust the height as needed */
                overflow: hidden;
            }
        
            .image-container img {
                width: 100%;
                height: 100%;
                object-fit: cover; /* This ensures the image covers the entire container */
            }
        </style>
        
        <div class="container">
            <div class="row">
                @foreach($resources as $resource)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-lg rounded">
                        <div class="card-body">
                            <div class="image-container mb-3">
                                <img src="{{ asset('uploads/' . $resource->file) }}" class="card-img-top" alt="{{ $resource->name }}">
                            </div>
                            <p class="card-text">{{ $resource->location }}</p>
                            <p class="card-text">{{ $resource->category }}</p>
                            <p class="card-text">{{ $resource->about }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-lg btn-primary w-100 mb-2" onclick="showComingSoon()" style="background-color: maroon">Contact Seller</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </main>
    @include('includes.footer')
</div>
<script>
    document.getElementById('addResourceForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        fetch(this.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Resource added successfully.',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/learning-resources";
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while processing your request.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while processing your request.',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
