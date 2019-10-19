<?PHP
function exist_in_db($name, $key, $db)
{
	foreach ($db as $product)
		if ($product[$key] == $name)
			return (TRUE);
	return (FALSE);
}

function create_product($name, $price, $category, $img = NULL)
{
	if (! gettype($name) == "string" || ! gettype($price) == "double" || !(gettype($category) == "array"
		|| gettype($category) == "string") || (isset($img) && ! gettype($img) == "string"))
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
	if (gettype($category) == "array")
		$product[categories] = $category;
	else
		$product[categories][0] = $category;
	if (isset($img))
		$product[img] = $img;
	else
		$product[img] = "img/default.png";
	if (! file_exists("database/categories"))
		$categories = array();
	else
		$categories = unserialize(file_get_contents("database/categories"));
	$db[] = $product;
	foreach	($product[categories] as $category)
		$categories[$category][] = array_search($product, $db);
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
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
	$db[$key] = $new_product;
	foreach($product[categories] as $category)
		unset($categories[$category][array_search($key, $categories[$category])]);
	foreach	($new_product[categories] as $category)
		$categories[$category][] = $key;
	file_put_contents('database/products', serialize($db));
	file_put_contents('database/categories', serialize($categories));
	return TRUE;
}
?>
