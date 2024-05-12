@include('includes.header')
{{-- Sidebar --}}
@include('includes.sidebar')
{{-- Topbar --}}
<div class="main">
    @include('includes.topbar')
    {{-- Main Content --}}
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Tbooke Blueboard
                <button class="btn btn-lg btn-primary" onclick="showAddAnnouncementForm()" style="background-color: maroon">
                    <i class="fas fa-plus"></i>Add Announcement
                </button>
                <button class="btn btn-lg btn-primary" onclick="showComingSoon()" style="background-color: maroon; border-color: #008080;">
                    Edit
                </button>
            </h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <section>
                    <h2 class="h3 mb-3">Important Announcements</h2>
                    <!-- Important Announcements section content -->
                    <!-- resources/views/announcements/index.blade.php -->
    <div class="container">
        <div class="row">
            @foreach ($announcements as $announcement)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">{{ $announcement->content }}</p>
                            <p class="card-text"><small class="text-muted">Published on: {{ $announcement->created_at->format('F j, Y') }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


                </section>
            </div>

            <div class="col-md-6">
                <section>
                    <h2 class="h3 mb-3">Upcoming Announcements</h2>
                    <!-- Upcoming Announcements section content -->
                </section>
            </div>
        </div>
    </main>
</div>
</div>
<!-- Form Modal -->
<div id="addAnnouncementModal" style="display: none;">
    <form id="announcementForm" action="{{ route('announcements.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="messageTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="messageTitle" name="messageTitle">
        </div>
        <div class="mb-3">
            <label for="messageContent" class="form-label">Content</label>
            <textarea class="form-control" id="messageContent" name="messageContent" rows="3"></textarea>
        </div>
    </form>
</div>
@include('includes.footer')
</div>
<script>
    function showAddAnnouncementForm() {
        Swal.fire({
            title: 'Add New Announcement',
            html: document.getElementById('addAnnouncementModal').innerHTML,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            focusConfirm: false,
            preConfirm: () => {
                const title = Swal.getPopup().querySelector('#messageTitle').value;
                const content = Swal.getPopup().querySelector('#messageContent').value;
                // Send AJAX request to store announcement
                fetch('{{ route("announcements.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ title, content })
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Announcement added successfully.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('tbooke-blueboard') }}"; // Redirect to homepage after success
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
            }
        });
    }
</script>

