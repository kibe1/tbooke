
        {{-- <div class="container">
            <section class="corner">
                <h2>Advertise Your School</h2>
                <form action="{{ route('submit-form') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="school_name" class="form-label">School Name</label>
                        <input type="text" class="form-control" id="school_name" name="school_name">
                    </div>
                    <div class="mb-3">
                        <label for="advertisement" class="form-label">Advertisement</label>
                        <textarea class="form-control" id="advertisement" name="advertisement" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </section>
        </div> --}}
        
        {{-- <div class="container">
            @foreach($submissions as $submission)
                <section class="corner">
                    <h2>{{ $submission->school_name }}</h2>
                    <p>{{ $submission->advertisement }}</p>
                    <img src="{{ asset('storage/images/' . $submission->image) }}" alt="Advertisement Image">
                </section>
            @endforeach
        </div>
         --}}

{{-- <style>
.container {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

h1 {
    color: #333;
}

.corner  {
    background-color: #fff;
    margin: 20px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.corner img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 15px;
}

            </style>
     --}}
        

@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')

{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Welcome to Our Schools Corner<!-- Modify your existing HTML to add an element that triggers the modal -->
                <button onclick="showFormModal()" class="btn btn-primary"  style="background-color: maroon; border-color: #008080;"><i class="fas fa-plus"></i>Add Advert</button>
                </h1>
        </div>


        {{-- links --}}
         <!-- Font Awesome -->
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
         <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
         <!-- jQuery -->

<!-- Add this to your HTML file -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showFormModal() {
        Swal.fire({
            title: 'POST AS A SCHOOL',
            html: `
            <form id="submit-form" action="{{ route('submit-form') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="mb-3">
                        <label for="school_name" class="form-label">School Name</label>
                        <input type="text" class="form-control" id="school_name" name="school_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="advertisement" class="form-label">Advertisement</label>
                        <textarea class="form-control" id="advertisement" name="advertisement" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            `,
            customClass: {
                title: 'modal-title',
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary'
            },
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
        });
    }
</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submit-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Submit the form data via AJAX
            axios.post(this.action, new FormData(this))
                .then(function (response) {
                    // Show success message
                    Swal.fire({
                        title: 'Success',
                        text: 'Form submitted successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                })
                .catch(function (error) {
                    // Show error message
                    Swal.fire({
                        title: 'Error',
                        text: 'Form submission failed. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    });
</script>





    </main>
    {{-- footer --}}
    @include('includes.footer')
</div>
