<?php if (!isLoggedInAdmin()) {
    redirect('login.php');
} ?>