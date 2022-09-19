<?php
        ob_start() ;
        session_start() ;
// Create constants to store non-repeating values
define('SITEURL','http://localhost/amp-holistic/') ;
define('LOCALHOST', 'localhost') ;
define('DB_USERNAME', 'root') ;
define('DB_PASSWORD', '') ;
define('DB_NAME', 'amp_holistic') ;

// Create database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()) ;
// Selecting database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()) ;

?>