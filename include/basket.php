<?PHP
function basket($login, $id, $amount = 1)
{
	if (gettype($login) != "string" || gettype($id) != "integer" || gettype($amount) != "integer")
		return FALSE;
	if (! file_exists("database"))
		mkdir("database");
	if (! file_exists("database/baskets"))
		$baskets = array();
	else
		$baskets = unserialize(file_get_contents("database/baskets"));
	if (isset($baskets[$login]) && isset($baskets[$login][$id]))
		if ($baskets[$login][$id] + $amount >= 0)
			$baskets[$login][$id] += $amount;
		else
			return FALSE;
	elseif ($amount > 0)
		$baskets[$login][$id] = $amount;
	else
		return FALSE;
	if ($baskets[$login][$id] == 0)
		unset($baskets[$login][$id]);
	file_put_contents("database/baskets", serialize($baskets));
	return TRUE;
}

function basket_delete($login)
{
	if (! file_exists("database") || ! file_exists("database/baskets"))
		return FALSE;
	$baskets = unserialize(file_get_contents("database/baskets"));	
	if (!isset($baskets[$login]))
		return FALSE;
	unset($baskets[$login]);
	file_put_contents("database/baskets", serialize($baskets));
	return TRUE;
}
?>
