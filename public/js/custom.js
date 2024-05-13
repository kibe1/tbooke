//creating a post

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createPostForm');
    const submitBtn = document.getElementById('submitPostBtn');

    submitBtn.addEventListener('click', function () {
        // Create a FormData object from the form
        const formData = new FormData(form);

        // Send a POST request using AJAX
        fetch(postStoreRoute, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
            .then(response => {
                if (response.ok) {
                    // Close the modal after successful submission
                    $('#createPost').modal('hide');

                    // Show the success modal
                    $('#successModal').modal('show');

                    // Close the success modal after 10 seconds
                    setTimeout(function () {
                        $('#successModal').modal('hide');
                    }, 2000); 
                } else {
                    throw new Error('Failed to create post');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to create post');
            });
    });
});


//Applying to become a creator

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('creatorModeForm');
    const submitBtn = document.getElementById('submitRequestBtn');

    submitBtn.addEventListener('click', function () {
        // Create a FormData object from the form
        const formData = new FormData(form);

        // Send a POST request using AJAX
        fetch(creatorApplicationRoute, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
            .then(response => {
                if (response.ok) {
                    // Close the modal after successful submission
                    $('#creatorMode').modal('hide');

                    // Show the success modal
                    $('#successModalApplication').modal('show');

                    setTimeout(function () {

                        $('#successModalApplication').modal('hide');
                        
                    }, 2000);

                } else {
                    throw new Error('Application failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Application failed');
            });
    });
});


$(document).ready(function () {
    $('#successModal').on('hidden.bs.modal', function () {
        // Remove the modal backdrop
        $('.modal-backdrop').remove();

        // Reset the form after modal is closed
        var form = document.getElementById('createPostForm');
        form.reset();

         // Refresh the page after dismissing the success modal
         location.reload();
    });
})

$(document).ready(function () {
    $('#successModalApplication').on('hidden.bs.modal', function () {
        // Remove the modal backdrop
        $('.modal-backdrop').remove();

        // Reset the form after modal is closed
        var form = document.getElementById('creatorModeForm');
        form.reset();

         // Refresh the page after dismissing the success modal
         location.reload();
    });
})


//posting a comment/reply

$(document).ready(function () {
    $('.comment-toggle-btn').click(function (e) {
        e.preventDefault();
        $(this).closest('.d-flex').find('.comment-box').toggle();
    });

});


// Posting comments

document.addEventListener('DOMContentLoaded', function () {
    // Select all comment forms and corresponding submit buttons
    const commentForms = document.querySelectorAll('[id^="createCommentForm"]');
    const submitButtons = document.querySelectorAll('[id^="submitCommentBtn"]');

    // Loop through each form and button pair
    commentForms.forEach((form, index) => {
        const submitCommentBtn = submitButtons[index]; // Get the corresponding submit button

        submitCommentBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(form);

            fetch(commentStoreRoute, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => {
                if (response.ok) {
                    console.log('Comment submitted successfully');
                    // Reload the page after successful comment submission
                    window.location.reload();
                } else {
                    throw new Error('Failed to create comment');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to create comment');
            });
        });
    });
});

//textarea
    tinymce.init({
        selector: '.tinymce-textarea', // Use a class for the text area you want to convert
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        menubar: false,
    });

