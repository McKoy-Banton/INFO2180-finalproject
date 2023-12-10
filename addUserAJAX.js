
function addUser() {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Get form data
    var formData = new FormData(document.querySelector('form'));

    // Define the request type, URL, and asynchronous setting
    xhr.open("POST", "addUser.php", true);

    // Set up the callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Update the content of a specific element on the page
                document.getElementById("response-message").innerHTML = xhr.responseText;
            } else {
                console.error("Error: " + xhr.status);
            }
        }
    };

    // Send the form data as the request payload
    xhr.send(formData);
}


/*
 *IMPORTANT NOTICE:
 
*/
