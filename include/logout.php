<?PHP
session_start();
header("Location: ../");
unset($_SESSION[loggued_on_user]);
?>