<?php

    function autoload($class)
    {
        require_once(strtolower($class).'.php');
    }

    spl_autoload_register('autoload');
    $db = Db::getInstance();

	$update_product = $_POST['update_product'] ?? false; 
	$delete_product = $_POST['delete_product'] ?? false;
    $insert = $_POST['insert'] ?? false;
	$add_product = $_POST['add_product'] ?? false;
	$update_category = $_POST['update_category'] ?? false;
    $delete_category = $_POST['delete_category'] ?? false;
    $insert_category = $_POST['insert_category'] ?? false;
    
    
    if($insert_category)
    {
        $name = $_POST['name'];
        insert_category($name, $db);
    }

    if($delete_category)
    {
        $category_id = $_POST['id'];
        delete_category($category_id, $db);
    }

	if($update_category)
    {
        $category_id = $_POST['id'];
        $category_name = $_POST['category_name'];
        
        update_category($category_id, $category_name, $db);
    }
	
	if($add_product)
    {
        $product_name = $_POST['product_name'];
        $parent_id = $_POST['parent_id'] ?? false;
        
        add_product_to_category($product_name, $parent_id, $db);
    }
	
    if($delete_product)
    {
        $product_id = $_POST['id'];
        delete_product($product_id, $db);
    }
    
    if($insert)
    {
        $name = $_POST['name'];
        $category_id = $_POST['id'];
        insert($name, $category_id, $db);
    }

	if($update_product)
    {
        $value = $_POST['value'];
        $product_id = $_POST['id'];
        
        update_product($product_id, $value, $db);
    }
	
    
    function insert_category($name ,$db)
    {
        $sql = "insert into category(name) values('{$name}')";
        $result = mysqli_query($db->connection, $sql);
    }

    function delete_category($id, $db)
    {
        $sql = "delete from category where id = {$id}";
        $result = mysqli_query($db->connection, $sql);
    }

	function update_category($category_id, $category_name, $db)
    {
        $sql = "update category set name = '{$category_name}' where id={$category_id}";
        $result = mysqli_query($db->connection, $sql);
    }
	
    function delete_product($product_id,$db){
        
        $sql = "delete from products where id = {$product_id}";
        $result = mysqli_query($db->connection, $sql);
    }

    function insert($name, $category_id, $db)
    {
        $sql = "insert into products(name,category_id) values('{$name}',{$category_id})";
        $result = mysqli_query($db->connection, $sql);
    }
	
	function update_product($product_id, $value, $db)
    {
        $sql = "update products set name = '{$value}' where id={$product_id}";
        $result = mysqli_query($db->connection, $sql);
    }
	
	function add_product_to_category($product_name, $category_id, $db)
    {
        $query = "select name from products where id = {$product_name}";
        $result = mysqli_query($db->connection, $query);
        $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
        $sql = "insert into products(name,category_id) values('{$row[0]['name']}',{$category_id})";
        $result = mysqli_query($db->connection, $sql);
    }