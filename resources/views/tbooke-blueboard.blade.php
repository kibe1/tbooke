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
                <h1 class="h3">Tbooke Blueboard</h1>
                <button class="btn btn-lg btn-primary ms-auto" onclick="showAddAnnouncementForm()"
                style="background-color: maroon">
                     Add Announcement
                </button>
            </div>
        </div>
        <style>
        .h3 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #008080;
    }
        </style>

        <div class="row">
            <div class="col-md-6">
                <section>
                    <h2 class="mb-3">Important Announcements</h2>
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
                    <h2 class="mb-3">Upcoming Announcements</h2>
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
        <div class="mb-3">
            <label for="imageUpload" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="imageUpload" name="imageUpload">
        </div>
        <div class="mb-3">
            <label for="documentUpload" class="form-label">Upload Document</label>
            <input type="file" class="form-control" id="documentUpload" name="documentUpload">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" 
            id="importantCheckbox" name="importantCheckbox">
            <label class="form-check-label" for="importantCheckbox">Important</label>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" 
            id="upcomingCheckbox" name="importantCheckbox">
            <label class="form-check-label" for="upcommingCheckbox">Upcomming</label>
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

                return fetch('{{ route("announcements.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ messageTitle: title, messageContent: content })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    );
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Announcement added successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = "{{ route('tbooke-blueboard') }}";
                });
            }
        });
    }
</script>
