<?PHP
session_start();
function auth($login, $passwd)
{
	$passwd = hash('sha512', $passwd);
	$db = unserialize(file_get_contents("../database/users"));
	if (isset($db[$login]) && $db[$login][passwd] == $passwd)
		return TRUE;
	return FALSE;
}
?>
<?PHP if (!isset($_POST[login]) || $_POST[login] == "" || !isset($_POST[passwd]) || $_POST[passwd] == "" || isset($_SESSION[loggued_on_user])
|| !file_exists("../database") || !file_exists("../database/users") || !auth($_POST[login], $_POST[passwd])):
	header("Location: ../login.php?auth=error");
?>
<?PHP else:
	$_SESSION[loggued_on_user] = $_POST[login];
	header("Location: ../login.php");
?>
<?PHP endif; ?>