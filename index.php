<?php include "components/header.php" ?>
<?php include "components/navbar.php" ?>

<?PHP
function begin_display() {
    echo '
    <style>
    .my_list_item {
        display: flex;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .my_item {
        margin: 20px;
        max-width: 100px;
        height: 200px;
        background-color: white;
        border-radius: 5px;
        text-align: center;
        box-shadow: 1px 2px 3px 0px rgba(0, 0, 0, 0.10);
    }
    
    .my_img_container {
        max-width: 100px;
        height: 100px;
        overflow: hidden;
    }
    
    .my_img_container img {
        object-fit: contain;
        width: 100%;
        height: 100%;
    }
    
    .my_item_name {
        overflow: hidden;
    }
    
    .my_item_price {
        overflow: hidden;
    }
    </style>
    <div class="my_list_item">
    ';
}

function display_item ($name, $price, $picture_path) {
    echo "
    <div class='my_item'>
    <div class='my_img_container'>
        <img src='$picture_path' alt=''>
    </div>
    <h3 class='my_item_name'> $name </h3>
    <h4 class='my_item_price'> $price €</h4>
</div>
    ";
}

function end_display() {
    echo '</div>';
}

$db = unserialize(file_get_contents('database/products'));
$categories = unserialize(file_get_contents('database/categories'));
if (isset($_GET[category]) && $_GET[category] != NULL)
{
    begin_display();
    foreach($categories[$_GET[category]] as $item)
        display_item($db[$item][name], $db[$item][price], $db[$item][img]);
    end_display();
}
else
{
    begin_display();
    foreach($db as $item => $val)
        display_item($db[$item][name], $db[$item][price], $db[$item][img]);
    end_display();
}
?>

<?php include "components/footer.php" ?>
