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
	if (gettype($name) != "string" || !(gettype($price) == "double" || gettype($price) == "integer") || (isset($img) && gettype($img) != "string"
	|| (isset($category) && !(gettype($category) == "string" || gettype($category) == "array"))))
		return FALSE;
	if (! file_exists("database"))
		mkdir("database");
	if (! file_exists("database/products"))
		$db = array();
	else
	{
		$db = unserialize(file_get_contents("database/products"));
		if (exist_in_db($name, "name", $db))
			return FALSE;
	}
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

function modify_product($name, $new_product)
{
	if (! file_exists("database") || ! file_exists("database/products") || ! file_exists("database/categories")
	|| (isset($new_product[price]) && !(gettype($new_product[price]) == "double" || gettype($new_product[price]) == "integer"))
	|| (isset($new_product[categories]) && gettype($new_product[categories]) != "array")
	|| (isset($new_product[name]) && $new_product[name] == "") || (isset($new_product[img]) && $new_product[img] == ""))
		return FALSE;
	$db = unserialize(file_get_contents("database/products"));
	$categories = unserialize(file_get_contents("database/categories"));
	if (! exist_in_db($name, "name", $db))
		return FALSE;
	foreach($db as $current)
		if ($current[name] == $name)
			$product = $current;
	$key = array_search($product, $db);
	if (isset($new_product[name]))
		$db[$key][name] = $new_product[name];
	if (isset($new_product[price]))
		$db[$key][price] = $new_product[price];
	if (isset($new_product[img]))
		$db[$key][img] = $new_product[img];
	if (isset($new_product[categories]))
	{
		$db[$key][categories] = $new_product[categories];
		foreach($product[categories] as $key => $category)
			unset($categories[$category][array_search($key, $categories[$category])]);
		foreach	($new_product[categories] as $category)
			$categories[$category][] = $key;
	}
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}
?>
