<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.21/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.21/dist/sweetalert2.min.js"></script>

<script>
    // Function to open the edit form with category details
    function openEditForm(id, name, description) {
        document.getElementById('edit-category-id').value = id;
        document.getElementById('edit-category-name').value = name;
        document.getElementById('edit-category-description').value = description;
    }

    // Function to set delete data for category
    function setDeleteData(id, name) {
        // Set the category ID in the hidden input field
        document.getElementById('delete-category-id').value = id;

        // Set the category name in the input field (readonly)
        document.getElementById('category-name').value = name;
    }

    // Function to view category details
    function viewCategory(name, description, createdAt, updatedAt) {
        document.getElementById('view-category-name').innerText = name;
        document.getElementById('view-category-description').innerText = description;
        document.getElementById('view-category-created').innerText = createdAt;
        document.getElementById('view-category-updated').innerText = updatedAt;
    }

    // Function to validate that input only contains letters and spaces
    function validateLettersOnly(event) {
        var input = event.target.value;

        // Regular expression to match only letters (both upper and lower case) and spaces
        var regex = /^[A-Za-z\s]*$/;

        // Check if the input contains anything other than letters or spaces
        if (!regex.test(input)) {
            // Remove invalid characters
            event.target.value = input.replace(/[^A-Za-z\s]/g, '');

            // Display a SweetAlert if invalid characters are detected
            if (!event.target.dataset.invalidAlertShown) {
                Swal.fire({
                    icon: 'error',          // Icon for error
                    title: 'Invalid Input',
                    text: 'Only letters and spaces are allowed. Numbers and symbols are not allowed.',
                    confirmButtonText: 'Okay',   // Button text
                    allowOutsideClick: false     // Prevent closing by clicking outside
                });

                // Set flag to prevent multiple alerts
                event.target.dataset.invalidAlertShown = 'true';
            }
        } else {
            // Reset the alert flag if input is valid
            event.target.dataset.invalidAlertShown = 'false';
        }
    }

    // Ensure the DOM is fully loaded before attaching event listeners
    window.onload = function() {
        // Event listener to apply the letter-only validation on input fields
        document.getElementById('category_name').addEventListener('input', validateLettersOnly);
        document.getElementById('category_description').addEventListener('input', validateLettersOnly);
    };
    
</script>
