<?php

// rmdir('../files_users/' . $_SESSION['user_login']['email']);

session_start();
session_unset();
session_destroy();
header('location: ../');
exit;
