<?PHP
include('user.php');
?>
<?PHP if (!isset($_POST[login]) || $_POST[login] == "" || !isset($_POST[passwd])|| $_POST[passwd] == ""
|| !isset($_POST[cpasswd]) || $_POST[cpasswd] == ""):
	header("Location: ../register.php?creation=failure1");
?>
<?PHP elseif ($_POST[passwd] != $_POST[cpasswd]):
	header("Location: ../register.php?creation=failure2");
?>
<?PHP elseif (!create_user($_POST[login], $_POST[passwd]) == 1):
	header("Location: ../register.php?creation=failure3");
?>
<?PHP else:
	header("Location: ../register.php?creation=success");
?>
<?PHP endif; ?>