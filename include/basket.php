<?PHP
function basket($uid, $id, $amount = 1)
{
	if (gettype($uid) != "integer" || gettype($id) != "integer" || gettype($amount) != "integer")
		return FALSE;
	if (! file_exists("database"))
		mkdir("database");
	if (! file_exists("database/baskets"))
		$baskets = array();
	else
		$baskets = unserialize(file_get_contents("database/baskets"));
	if (isset($baskets[$uid]) && isset($baskets[$uid][$id]))
		if ($baskets[$uid][$id] + $amount >= 0)
			$baskets[$uid][$id] += $amount;
		else
			return FALSE;
	elseif ($amount > 0)
		$baskets[$uid][$id] = $amount;
	else
		return FALSE;
	if ($baskets[$uid][$id] == 0)
		unset($baskets[$uid][$id]);
	file_put_contents("database/baskets", serialize($baskets));
	return TRUE;
}
?>
