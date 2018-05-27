<?php
    session_start();

    include 'header.php';

    function autoload($class)
     {
         require_once(strtolower($class).'.php');
     }

    spl_autoload_register('autoload');

    $db = Db::getInstance();
    
            
    if($_POST['logout'] ?? false)
    {
        $_SESSION = array();     // или $_SESSION = array() для очистки всех данных сессии
        $_SESSION['authorized'] = false;
        session_destroy();
        header('Location: index.php');
    }
    
    //die(var_dump($_SESSION['save']));

    $result = mysqli_query($db->connection, "SELECT * FROM category ");
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $cnt = count($row);
    
?>
<div class="side">
<ul class="menu">
    <?php
    for($i = 0; $i < $cnt; $i++)
    {
        ?>
    <li class="menu__list"><a onclick="popup_ajax('edit.php/<?=$row[$i]['name']?>/0/<?=$row[$i]['id']?>')"><?= $row[$i]['name'] ?></a>
        <?php
            
            $result = mysqli_query($db->connection, "SELECT * FROM  products where category_id = {$row[$i]['id']}");
            $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
            
            $cnt_prod = count($products);
            ?>
        <ul class="menu_drop">
            <?php
                for($j = 0; $j < $cnt_prod; $j++)
                { //die(var_dump($products[$j]['products_name']));
            ?>
                <li> <a onclick="popup_ajax('edit.php/<?= $products[$j]['name'] ?>/1/<?= $products[$j]['id'] ?>')"><?= $products[$j]['name'] ?> </a></li>
            <?php
                }
            ?>
        </ul>
    </li>
    <?php
    }
    
?>
    </ul>
</div>
    <input id="form_category" type="submit" onclick="form_category();" value="Добавить категорию">
    
    <div class="popup_window"></div>
    <div class="product_window"></div>
    <div class="create_window"></div>


    
