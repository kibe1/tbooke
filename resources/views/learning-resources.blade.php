@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3">Tbooke Shop</h1>
                <button class="btn btn-lg btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addResourceModal" style="background-color: maroon">
                    <i class="fas fa-plus"></i> Sell On Tbooke
                </button>
            </div>
        </div>
        
        <!-- Add Resource Modal -->
        <div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addResourceModalLabel">Sell On Tbooke</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        <label for="resourceName" class="form-label">Name of the Item</label>
                                        <input class="form-control rounded" type="text" id="resourceName" name="name">
                                    </div>
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
                                <label for="resourcePrice" class="form-label">Price</label>
                                <input class="form-control rounded" type="number" id="resourcePrice" name="price" min="0" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="resourceDiscountedPrice" class="form-label">Discounted Price</label>
                                <input class="form-control rounded" type="number" id="resourceDiscountedPrice" name="discounted_price" min="0" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="resourcePhone" class="form-label">Add Phone</label>
                                <input class="form-control rounded" type="number" id="resourcePhone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="resourceEmail" class="form-label">Add Email</label>
                                <input class="form-control rounded" type="email" id="resourceEmail" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="resourceWhatsapp" class="form-label">Add Whatsapp</label>
                                <input class="form-control rounded" type="number" id="resourceWhatsapp" name="whatsapp">
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
                                <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-lg btn-primary" id="saveResourceBtn" style="background-color: maroon">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .h3 {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
                color: #008080;
            }
            .image-container {
                height: 200px;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .image-container img {
                width: 100%;
                height: auto;
                object-fit: cover;
            }
            .card {
                display: flex;
                flex-direction: column;
                height: 100%;
            }
            .card-body {
                flex: 1 1 auto;
            }
            .card-footer {
                flex-shrink: 0;
            }
        </style>
        
        <div class="container">
            <div class="row">
                @php
                    $resources = $resources->sortByDesc('created_at');
                    $chunks = $resources->chunk(4);
                    $chunkCount = 0;
                @endphp
                @foreach($chunks as $chunk)
                    @if ($chunkCount > 0 && $chunkCount % 3 == 0)
                        <div class="col-12">
                            <hr>
                        </div>
                    @endif
                    @foreach($chunk as $resource)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card border-0 shadow-lg rounded h-100">
                            <div class="image-container">
                                <img src="{{ asset('uploads/' . $resource->file) }}" class="card-img-top" alt="{{ $resource->name }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="card-text"><strong>Name: </strong>{{ $resource->name }}</p>
                                <p class="card-text"><strong>Category: </strong>{{ $resource->category }}</p>
                                <p class="card-text"><strong>Description: </strong>{{ $resource->about }}</p>
                                <p class="card-text"><strong>Price: </strong>Ksh. {{ number_format($resource->price, 2) }}</p>
                                @if($resource->discounted_price)
                                <p class="card-text"><strong>Discounted Price: </strong>Ksh. {{ number_format($resource->discounted_price, 2) }}</p>
                                @endif
                                <p style="color: maroon; font-size: 24px;">Contact Seller</p>
                                <div class="contact-icons">
                                    <a href="tel:{{ $resource->phone }}" title="Call">
                                        <i class="fas fa-phone" style="font-size: 24px; margin-right: 15px;"></i>
                                    </a>
                                    <a href="https://wa.me/{{ $resource->whatsapp }}" target="_blank" title="WhatsApp">
                                        <i class="fab fa-whatsapp" style="font-size: 24px; margin-right: 15px;"></i>
                                    </a>
                                    <a href="mailto:{{ $resource->email }}" title="Email">
                                        <i class="fas fa-envelope" style="font-size: 24px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @php
                        $chunkCount++;
                    @endphp
                @endforeach
            </div>
        </div>
        
        <style>
            .contact-icons {
                display: flex;
                justify-content: center;
                gap: 10px;
                font-size: 24px;
                color: #008080;
            }
            .contact-icons a {
                color: #008080;
                text-decoration: none;
            }
        </style>
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
