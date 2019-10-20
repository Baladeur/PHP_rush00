<?PHP
function create_category($name, $ids = NULL)
{
	if (gettype($name) != "string" || (isset($ids) && (gettype($ids) != "array" || ! file_exists("database/products"))))
		return FALSE;
	if (! file_exists("database"))
		mkdir("database");
	if (! file_exists("database/categories"))
		$categories = array();
	else
		$categories = unserialize(file_get_contents("database/categories"));
	if (array_key_exists($name, $categories))
		return FALSE;
	$db = unserialize(file_get_contents("database/products"));
	if (isset($ids))
		foreach($ids as $key)
			if (! array_key_exists($key, $db))
				return FALSE;
	$categories[$name] = isset($ids) ? $ids : array();
	if (isset($ids))
		foreach($ids as $key)
			$db[$key][categories][] = $name;
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}

function destroy_category($name)
{
	if (! file_exists("database") || ! file_exists("database/products") || ! file_exists("database/categories"))
		return FALSE;
	$db = unserialize(file_get_contents("database/products"));
	$categories = unserialize(file_get_contents("database/categories"));
	if (! array_key_exists($name, $categories))
		return FALSE;
	$ids = $categories[$name];
	unset($categories[$name]);
	foreach($ids as $id)
		unset($db[$id][categories][array_search($name, $db[$id][categories])]);
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}

function modify_category($name, $new_ids, $new_name)
{
	if (! file_exists("database") || ! file_exists("database/categories") || !isset($new) || (isset($new_name) && (gettype($new_name) != "string" || $new_name == ""))
	|| (isset($nw[ids]) && gettype($new_ids) != "array"))
		return FALSE;
	$categories = unserialize(file_get_contents("database/categories"));
	$db = unserialize(file_get_contents("database/products"));
	if (!isset($categories[$name]))
		return FALSE;
	$rname = isset($new_name) ? $new_name : $name;
	if (isset($new_ids))
	{
		foreach($categories[$name] as $product)
			unset($db[$product][categories][array_search($name,$db[$product][categories])]);
		foreach($new_ids as $id)
			$db[$id][categories][] = $rname;
		$categories[$name] = $new_ids;
	}
	if (isset($new_name))
	{
		foreach($categories[$name] as $id)
			$db[$id][categories][array_search($name,$db[$id][categories])] = $rname;
		$categories[$rname] = $categories[$name];
		unset ($categories[$name]);
	}
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}
?>
