<?PHP
function create_user($login, $passwd, $extra = NULL)
{
	if (gettype($login) != "string" || gettype($passwd) != "string" || (isset($extra[name]) && gettype($extra[name]) != "string")
	|| (isset($extra[surname]) && gettype($extra[surname]) != "string") || (isset($extra[permission]) && gettype($extra[permission]) != "integer"))
		return FALSE;
	if (! file_exists("../database"))
		mkdir("database");
	if (! file_exists("../database/users"))
		$users = array();
	else
		$users = unserialize(file_get_contents("../database/users"));
	if (isset($users[$login]))
		return FALSE;
	$users[$login][passwd]=hash("sha512", $passwd);
	if (isset($extra[name]))
		$users[$login][name] = $extra[name];
	if (isset($extra[surname]))
		$users[$login][surname] = $extra[surname];
	if (isset($extra[permission]))
		$users[$login][permission] = $extra[permission];
	else
		$users[$login][permission] = 0;
	file_put_contents("../database/users", serialize($users));
	return TRUE;
}

function destroy_user($login)
{
	if (! file_exists("database") || ! file_exists("database/users"))
		return FALSE;
	$users = unserialize(file_get_contents("database/users"));
	if (!isset($users[$login]))
		return FALSE;
	unset($users[$login]);
	file_put_contents("database/users", serialize($users));
	return FALSE;
}

function modify_user($login, $passwd, $new = NULL)
{
	if (! file_exists("database") || ! file_exists("database/users") || gettype($login) != "string" || gettype($passwd) != "string" || !isset($new)
	|| !count($new) || (isset($new[passwd]) && gettype($new[passwd]) != "string") || (isset($new[surname]) && gettype($new[surname]) != "string")
	|| (isset($new[permission]) && gettype($new[permission]) != "integer") || (isset($new[name]) && gettype($new[name]) != "string"))
		return FALSE;
	$users = unserialize(file_get_contents("database/users"));
	if (!isset($users[$login]))
		return FALSE;
	if (isset($new[passwd]) && hash("sha512", $new[passwd]) == $users[$login])
		$users[$login][passwd] = hash("sha512", $new[passwd]);
	elseif (isset($new[passwd]))
		return FALSE;
	if (isset($new[name]))
		if ($new[name] != "")
			$users[$login][name] = $new[name];
		else
			unset($users[$login][name]);
	if (isset($new[surname]))
		if ($new[surname] != "")
			$users[$login][surname] = $new[surname];
		else
			unset($users[$login][surname]);
	if (isset($new[permission]))
		$users[$login][permission] = $new[permission];
	file_put_contents("database/users", serialize($users));
	return TRUE;
}
?>
