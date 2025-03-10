// Form Validation and Interactivity

// Wait for the DOM to be fully loaded before executing the script
document.addEventListener('DOMContentLoaded', function() {
    // Email validation function
    function validateEmail(email) { // Regular expression to validate email format
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Test the email against the regex and return true/false
        return re.test(String(email).toLowerCase());
    }

    // Phone number validation function
    function validatePhone(phone) {
        const re = /^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/; // Regular expression to validate phone number format
        return re.test(String(phone)); // Test the phone number against the regex and return true/false
    }

    // Generic form validation function
    function validateForm(form) {
        let isValid = true;  // Assume the form is valid initially
        
        // Clear previous error messages
        const errorMessages = form.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove()); // Remove all existing error messages

        // Validate required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) { // If a required field is empty, display an error
                displayError(field, 'This field is required');
                isValid = false; // Mark the form as invalid
            }
        });

        // Email validation (if email field exists)
        const emailField = form.querySelector('input[type="email"]');
        if (emailField && emailField.value.trim() && !validateEmail(emailField.value)) {
            displayError(emailField, 'Please enter a valid email address'); // If the email is invalid, display an error
            isValid = false; // Mark the form as invalid
        }

        // Phone validation (if phone field exists)
        const phoneField = form.querySelector('input[type="tel"]');
        if (phoneField && phoneField.value.trim() && !validatePhone(phoneField.value)) { 
            displayError(phoneField, 'Please enter a valid phone number'); // If the phone number is invalid, display an error
            isValid = false;
        }

        return isValid; // Mark the form as invalid
    }

    // Function to display error messages next to fields
    function displayError(field, message) {
        const errorSpan = document.createElement('span'); // Create a new span element
        errorSpan.className = 'error-message'; // Add a class for styling
        errorSpan.style.color = 'red'; // Set text color to red
        errorSpan.style.fontSize = '0.8em'; // Set font size
        errorSpan.textContent = message; // Set the error message text
        
        field.parentNode.insertBefore(errorSpan, field.nextSibling); // Insert the error message after the field
    }

    // Attach form validation to all forms on the page
    const forms = document.querySelectorAll('form'); 
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {  // Validate the form before submission
            if (!validateForm(form)) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });

    // Booking date validation (ensure future dates)
    const bookingDateField = document.getElementById('booking_date');
    if (bookingDateField) {
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format  
        bookingDateField.setAttribute('min', today);  // Set the minimum allowed date to today
    }

    // Confirm deletion actions
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) { // Show a confirmation dialog before proceeding with deletion
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault(); // Cancel the action if the user clicks "Cancel"
            }
        });
    });
});