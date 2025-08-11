<?php
session_start();
session_unset();
session_destroy();

// Redirect to login page with no-cache headers
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Location: 2-login.html");
exit();
?>
