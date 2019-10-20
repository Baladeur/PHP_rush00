<?PHP
function exist_in_db($name, $key, $db)
{
	foreach ($db as $product)
		if ($product[$key] == $name)
			return (TRUE);
	return (FALSE);
}

function create_product($name, $price, $category = NULL, $img = NULL)
{
	if (gettype($name) != "string" || (gettype($price) != "double" && gettype($price) != "integer") || (isset($img) && gettype($img) != "string"
	|| (isset($category) && gettype($category) != "string" && gettype($category) != "array")))
		return FALSE;
	if (! file_exists("database"))
		mkdir("database");
	if (! file_exists("database/products"))
		$db = array();
	else
		$db = unserialize(file_get_contents("database/products"));
	if (exist_in_db($name, "name", $db))
		return FALSE;
	$product[name] = $name;
	$product[price] = $price;
	if (isset($category))
	{
		if (gettype($category) == "array")
			$product[categories] = $category;
		else
			$product[categories][0] = $category;
	}
	if (isset($img))
		$product[img] = $img;
	else
		$product[img] = "img/default.png";
	$db[] = $product;
	if (isset($category))
	{
		if (! file_exists("database/categories"))
			$categories = array();
		else
			$categories = unserialize(file_get_contents("database/categories"));
		foreach	($product[categories] as $category)
			$categories[$category][] = array_search($product, $db);
		file_put_contents('database/categories', serialize($categories));
	}
	file_put_contents('database/products', serialize($db));
	return TRUE;
}

function destroy_product($name)
{
	if (! file_exists("database") || ! file_exists("database/products") || ! file_exists("database/categories"))
		return FALSE;
	$db = unserialize(file_get_contents("database/products"));
	$categories = unserialize(file_get_contents("database/categories"));
	if (! exist_in_db($name, "name", $db))
		return FALSE;
	foreach($db as $current)
		if ($current[name] == $name)
			$product = $current;
	$key = array_search($product, $db);
	unset($db[$key]);
	foreach($product[categories] as $category)
		unset($categories[$category][array_search($key, $categories[$category])]);
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}

function modify_product($name, $new)
{
	if (! file_exists("database") || ! file_exists("database/products") || ! file_exists("database/categories")|| isset($new)
	|| !count($new) || (isset($new[price]) && (gettype($new[price]) != "double" && gettype($new[price]) != "integer"))
	|| (isset($new[categories]) && gettype($new[categories]) != "array")
	|| (isset($new[name]) && $new[name] == "") || (isset($new[img]) && $new[img] == ""))
		return FALSE;
	$db = unserialize(file_get_contents("database/products"));
	$categories = unserialize(file_get_contents("database/categories"));
	if (! exist_in_db($name, "name", $db))
		return FALSE;
	foreach($db as $current)
		if ($current[name] == $name)
			$product = $current;
	$key = array_search($product, $db);
	if (isset($new[name]))
		$db[$key][name] = $new[name];
	if (isset($new[price]))
		$db[$key][price] = $new[price];
	if (isset($new[img]))
		$db[$key][img] = $new[img];
	if (isset($new[categories]))
	{
		$db[$key][categories] = $new[categories];
		foreach($product[categories] as $key => $category)
			unset($categories[$category][array_search($key, $categories[$category])]);
		foreach	($new[categories] as $category)
			$categories[$category][] = $key;
	}
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}
?>
