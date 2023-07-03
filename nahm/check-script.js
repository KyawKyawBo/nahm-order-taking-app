var typingTimer;
var doneTypingInterval = 500; // Time in milliseconds (0.5 seconds)
function checkNameAvailability() {
    clearTimeout(typingTimer);
    var nameInput = document.getElementById('name');
    var name = nameInput.value;
    // Check if the name is not empty
    if (name.length > 0) {
        // Start a timer to wait for user to finish typing
        typingTimer = setTimeout(function () {
            // Make an AJAX request to the server
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response == 'available') {
                        var div = document.getElementById("error-message");
                        div.style.display = "block";
                        div.classList.remove("btn-danger");
                        div.classList.add("btn-primary");
                        document.getElementById('error-message').textContent = 'Name is available';
                    }
                    else {
                        var div = document.getElementById("error-message");
                        div.style.display = "block";
                        div.classList.remove("btn-primary");
                        div.classList.add("btn-danger");
                        document.getElementById('error-message').textContent = 'Name already exists';
                    }
                }
            };
            xhr.open('POST', 'check_name.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('name=' + encodeURIComponent(name));
        }, doneTypingInterval);
    } else {
        // Clear the availability message if the input is empty
        document.getElementById('error-message').textContent = '';
        document.getElementById('error-message').style.display = 'none';
    }
}
