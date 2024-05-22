//creating a post

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createPostForm');
    const submitBtn = document.getElementById('submitPostBtn');

    submitBtn.addEventListener('click', function (e) {
        e.preventDefault();
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

    submitBtn.addEventListener('click', function (e) {
        e.preventDefault(); 
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
        selector: '.tinymce-textarea', 
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        menubar: false,
    });


    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('followForm');
        const submitBtn = document.getElementById('followButton');
    
        submitBtn.addEventListener('click', function (e) {
            e.preventDefault();
            // Create a FormData object from the form
            const formData = new FormData(form);
    
            // Send a Follow request using AJAX
            fetch(userFollowRoute, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        throw new Error('Following failed');
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                    alert('Following failed');
                });
        });
    });    

    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('unfollowForm');
        const submitBtn = document.getElementById('unfollowButton');
    
        submitBtn.addEventListener('click', function (e) {

            e.preventDefault(); 

            // Create a FormData object from the form
            const formData = new FormData(form);
    
            // Send Unfollow request using AJAX
            fetch(userunfollowRoute, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        throw new Error('unfollowing failed');
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                    alert('unfollowing failed');
                });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const alertsDropdown = document.getElementById('alertsDropdown');
    
        if (alertsDropdown) {
            alertsDropdown.addEventListener('click', function () {
                fetch(notificationsClear, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    // Optionally update the UI to reflect the read notifications
                    document.querySelector('.indicator').innerText = 0;
                })
                .catch(error => console.error('Error:', error));
            });
        }
    });


    $(document).ready(function() {
        $('.like-unlike-form').submit(function(event) {
            event.preventDefault(); 

            var form = $(this);
            var action = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();
            var postId = form.data('post-id');
            var actionLike = form.data('action-like');
            var actionUnlike = form.data('action-unlike');
            var likeCount = ('#likes-count-' + postId);
            
            $.ajax({
                url: action,
                method: method,
                data: data,
                success: function(response) {

                if (action === actionLike) {
                    // Change to unlike button
                    form.attr('action', actionUnlike);
                    form.find('button').attr('id', 'unlikeButton-' + postId).removeClass('like-btn').addClass('unlike-btn engage-unlike-btn')
                        .html('<span class="d-none d-md-inline"><i class="feather-sm" data-feather="thumbs-down"></i> Unlike</span><span class="d-inline d-md-none"><i class="feather-sm" data-feather="thumbs-down"></i></span>');
                } else {
                    // Change to like button
                    form.attr('action', actionLike);
                    form.find('button').attr('id', 'likeButton-' + postId).removeClass('unlike-btn engage-unlike-btn').addClass('like-btn')
                        .html('<span class="d-none d-md-inline"><i class="feather-sm" data-feather="thumbs-up"></i> Like</span><span class="d-inline d-md-none"><i class="feather-sm" data-feather="thumbs-up"></i></span>');
                }

                $(likeCount).html('<i class="feather-sm" data-feather="thumbs-up"></i> ' + response.likesCount);     

                 // Reinitialize feather icons
                 feather.replace();

                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); 
                }
            });
        });
    });



    $(document).ready(function () {
        $('.share-form').on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            var postId = form.data('post-id');
            
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
    
                    // Show the success modal on share
                    $('#successModalonShare').modal('show');
    
                    // Close the success modal after 2.2 seconds
                    setTimeout(function () {
                        $('#successModalonShare').modal('hide');
                    }, 2200); 
    
                    // Update the repost count for the specific post
                    var postContainer = $('#post-' + postId);
                    var reshareCountElement = postContainer.find('#reshare-count-' + postId);
    
                    if (reshareCountElement.length === 0) {
                        // If the element doesn't exist, create it
                        var commentStats = postContainer.find('.comment-stats.float-end');
                        commentStats.append('<a class="text-muted reshare-count" id="reshare-count-' + postId + '" href="#">1 Repost</a>');
                    } else {
                        // If the element exists, update its count
                        var currentCount = parseInt(reshareCountElement.text().trim().split(' ')[0]) || 0;
                        reshareCountElement.text((currentCount + 1) + ' Reposts');
                    }
    
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    