// Admin Panel JavaScript

// Wait for the DOM to be fully loaded before executing the script
document.addEventListener('DOMContentLoaded', () => {
    console.log("Admin panel scripts loaded"); // Logs a message to confirm the script is loaded

    // Example functionality: Toggle sidebar visibility
    const sidebarToggle = document.querySelector('#sidebar-toggle');  // Select the sidebar toggle button using its ID (#sidebar-toggle)
    // Check if the sidebar toggle button exists
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => { // Add a click event listener to the toggle button
            document.querySelector('.admin-sidebar').classList.toggle('hidden'); // Toggle the 'hidden' class on the sidebar element
        });
    }
});
