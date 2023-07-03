// Set the idle timeout duration (5 minutes in this example)
const IDLE_TIMEOUT = 300000; // 5 minutes in milliseconds

let idleTimer;

function resetTimer() {
    clearTimeout(idleTimer);
    idleTimer = setTimeout(logout, IDLE_TIMEOUT);
}

function logout() {
    // Redirect to the logout PHP script
    window.location.href = "logout.php";
}

// Attach event listeners for user activity
document.addEventListener("mousemove", resetTimer);
document.addEventListener("keypress", resetTimer);
document.addEventListener("click", resetTimer);
