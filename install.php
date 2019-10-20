<?PHP
include "include/category.php";
include "include/product.php";
include "include/user.php";
create_product("Nikidas max500", 90, array("category" => array("Clothes", "Shoes")));
create_product("Mole bag", 25, array("category" => "Clothes"));
create_product("Nellogs Crunsties", 5, array("category" => array("Food", "Other")));
create_product("Spider-max PX5", 60, array("category" => array("Games")));
create_product("Controller PX5", 40.5, array("category" => array("Games", "Electronics")));
create_category("Food");
create_category("Clothes");
create_category("Games");
create_category("Electronics");
create_category("Music");
create_category("Shoes");
create_category("Other");
if (modify_user("Baladeur", "1234", array("permission" => 1)))
print_r(unserialize(file_get_contents('database/users')));
?>
