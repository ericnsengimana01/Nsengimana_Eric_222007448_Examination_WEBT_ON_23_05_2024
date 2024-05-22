// Function to validate the login form
function validateLoginForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (email.trim() === "" || password.trim() === "") {
        alert("Please enter both email and password.");
        return false;
    }

    // Additional validation logic can be added here
    return true;
}

// Function to load dynamic content based on user interaction
function loadContent(page) {
    // Make an AJAX request to fetch content based on the selected page
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the content area with the fetched data
            document.getElementById("content").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "load_content.php?page=" + page, true);
    xhttp.send();
}
