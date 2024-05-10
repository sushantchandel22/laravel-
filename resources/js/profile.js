
document.addEventListener("DOMContentLoaded", function() {
    // Get references to the profile image container and form
    var profileImageContainer = document.getElementById('profile-image-container');
    var profileForm = document.getElementById('profile-form');
    // Add click event listener to profile image container
    profileImageContainer.addEventListener('click', function() {
        // Trigger file input click when profile image is clicked
        document.getElementById('profile-image-input').click();
    });
    // Add change event listener to file input
    document.getElementById('profile-image-input').addEventListener('change', function() {
        // Submit form when file is selected
        profileForm.submit();
    });
});
            