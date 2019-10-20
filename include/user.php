<?PHP
function create_user($login, $passwd, $name = NULL, $surname = NULL, $permission =NULL)
{
	if (gettype($login) != "string" || gettype($passwd) != "string" || (isset($name) && gettype($name) != "string")
	|| (isset($surname) && gettype($surname) != "string") || (isset($permission) && gettype($permission) != "integer"))
		return FALSE;
	if (! file_exists("database"))
		mkdir("database");
	if (! file_exists("database/users"))
		$users = array();
	else
		$users = unserialize(file_get_contents("database/users"));
	if (array_search($login, $users))
		return FALSE;
	$users[$login][passwd]=hash("sha512", $passd);
	if (isset($name))
		$users[$login][name] = $name;
	if (isset($surname))
		$users[$login][surname] = $surname;
	if (isset($permission))
		$users[$login][permission] = $permission;
	file_put_contents("database/users", serialize($users));
	return TRUE;
}

function destroy_user($login)
{
	if (! file_exists("database") || ! file_exists("database/users"))
		return FALSE;
	$users = unserialize(file_get_contents("database/users"));
	if (!array_search($login, $users))
		return FALSE;
	unset($users[$login]);
	file_put_contents("database/users", serialize($users));
	return FALSE;
}

function modify_user($login, $passwd, $new_passwd = NULL, $new_name = NULL, $new_surname = NULL, $new_permission = NULL)
{
	if (! file_exists("database") || ! file_exists("database/users") || gettype($login) != "string" || gettype($passwd) != "string"
	|| (isset($new_passwd) && gettype($new_passwd) != "string") || (isset($new_surname) && gettype($new_surname) != "string") 
	|| (isset($new_permission) && gettype($new_permission) != "integer") || (isset($new_name) && gettype($new_name) != "string"))
		return FALSE;
	$users = unserialize(file_get_contents("database/users"));
	if (!array_search($login, $users))
		return FALSE;
	if (isset($new_passwd) && hash("sha512", $new_passwd) == $users[$login])
		$users[$login][passwd] = hash("sha512", $new_passwd);
	else
		return FALSE;
	if (isset($new_name))
		$users[$login][name] = $new_name;
	if (isset($new_surname))
		$users[$login][surname] = $new_surname;
	if (isset($new_premission))
		$users[$login][permission] = $new_permission;
	file_put_contents("database/users", serialize($users));
	return ;TRUE;
}
?>
