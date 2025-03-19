document.addEventListener('DOMContentLoaded', function() {
    // Check session status
    checkSession();
    
    // Get navigation menu items
    const navLinks = document.querySelectorAll('nav a');
    const sections = document.querySelectorAll('section');
    
    // Handle navigation menu clicks
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links and sections
            navLinks.forEach(l => l.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active-section'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Get the target section ID from the href
            const targetId = this.getAttribute('href');
            
            // Show the target section
            document.querySelector(targetId).classList.add('active-section');
        });
    });
    
    // Initialize AJAX form submissions
    setupFormHandlers();
    
    // Function to check session status
    function checkSession() {
        fetch('check_session.php')
        .then(response => response.text())
        .then(data => {
            if (data.includes('not_logged_in')) {
                window.location.href = 'index.html';
            } else {
                // Set username in the UI
                const usernameSpan = document.getElementById('username');
                if (usernameSpan) {
                    usernameSpan.textContent = data;
                }
            }
        })
        .catch(error => {
            console.error('Error checking session:', error);
        });
    }
    
    // Setup handlers for all forms
    function setupFormHandlers() {
        // Search form
        setupForm('search-form', 'search-results');
        
        // Add course form
        setupForm('add-form', 'add-results');
        
        // Update form
        setupForm('update-form', 'update-results');
        
        // Delete form
        setupForm('delete-form', 'delete-results');
        
        // Calculate grades form
        setupForm('calculate-form', 'calculate-results');
    }
    
    // Generic form handler setup
    function setupForm(formId, resultContainerId) {
        const form = document.getElementById(formId);
        if (!form) return;
        
        const resultsContainer = document.getElementById(resultContainerId);
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const url = this.getAttribute('action');
            
            // Show loading message
            resultsContainer.innerHTML = '<p>Processing...</p>';
            
            // Send AJAX request
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                resultsContainer.innerHTML = data;
            })
            .catch(error => {
                resultsContainer.innerHTML = '<p class="error">Error: ' + error.message + '</p>';
            });
        });
    }
});