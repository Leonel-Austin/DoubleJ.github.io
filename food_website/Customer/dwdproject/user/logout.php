<?php
session_start();
unset($_SESSION['Customer']);
unset($_SESSION['cart']);
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();
?>
<script>
    function clearLocalStorageAndRedirect() {
        localStorage.clear();
        window.location.href = "index.php";
    }
    window.onload = clearLocalStorageAndRedirect;
</script>
