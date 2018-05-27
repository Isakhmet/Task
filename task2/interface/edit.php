<?php
        
    function autoload($class)
    {
        require_once(strtolower($class).'.php');
    }

    spl_autoload_register('autoload');
    $db = Db::getInstance();

    $product_id = $_POST['product_id'] ?? 0;
    $category_id = $_POST['category_id'] ?? false;
    $create_product = $_POST['create_product'] ?? false;
    $create_category = $_POST['create_category'] ?? false;

    if($create_product)
    {
        $id = $_POST['parent_id'];
        create_product( $id);
    }

    if($product_id)
    {
        $type = $_POST['type'];
        $title = $_POST['product'];
        
        if($type == 0)
        {
            category($product_id, $title,$db);
        }
        else
        {
            edit($product_id,$title);
		}
    }

    if($category_id)
    {
        add_product($category_id, $db);
    }
  
    if($create_category)
    {
        create_category();
    }

    function create_category()
    {
        $output = '<form action="" method="post"><fieldset class="viewdata">';
        $output .= '<legend>Создать категорию</legend>';
        $output .= ' <div>
                            <label>Наименование</label>
                            <div class="panel_input">
                                <input name="Product" id="category_id"  style="float:left; display:block" type="text"/>
                            </div>
                        </div>
                    </fieldset>';
        $output .= '<div> <input type="button" value="Сохранить" name="Save" onclick="insert_category();"/>
                    <input type="button" onclick="hide_product();" value="Отмена"/></div></form>
                    ';

        echo $output;
    }
    
    function create_product($id)
    {
        $output = '<form action="" method="post"><fieldset class="viewdata">';
        $output .= '<legend>Создать продукт</legend>';
        $output .= ' <div>
                            <label>Наименование</label>
                            <div class="panel_input">
                                <input name="Product" id="product_id"  style="float:left; display:block" type="text"/>
                                <input name="Table" id="category_id" value="'.$id.'" style="float:left; display:none" type="text"/>
                            </div>
                        </div>
                    </fieldset>';
        $output .= '<div> <input type="button" value="Сохранить" name="Save" onclick="insert_product();"/>
                    <input type="button" onclick="hide_product();" value="Отмена"/></div></form>
                    ';

        echo $output;
    }

    function add_product($category_id, $db)
    {
        $sql = "select * from products";
        $result = mysqli_query($db->connection, $sql);
        $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $cnt = count($row);
        $option = '';
        
        for($i = 0; $i < $cnt; $i++)
        {
            $option .= '<option value="'.$row[$i]['id'].'">'.$row[$i]['name'].'</option> ';
        }
        
        $output = '<form action="" method="post"><fieldset class="viewdata">';
        $output .= '<legend>Добавить продукт</legend>';
        $output .= ' <div>
                        <div class="panel_input">
                            <input id="id" style="float:left; display:none" type="text" value="'.$category_id.'"/>
                        </div>
                        <div class="panel_input">
                            <select id="product_name" name="product_name" size = 1>
                                '.$option.'
                            </select>
                        </div>
                    </div>
                    </fieldset>';
        $output .= '<div> <input type="button" value="Сохранить" name="Save" onclick="submit_product();"/>
                        <input type="button" onclick="hide_product();" value="Отмена"/>
                    </div></form>';

        echo $output;
    }


    function edit($id, $title)
    {
        $output = '<form action="" method="post"><fieldset class="viewdata">';
        $output .= '<legend>Редактировать продукт</legend>';
        $output .= ' <div>
                            <label>Наименование</label>
                            <div class="panel_input">
                                <input name="Product" id="product_id"  style="float:left; display:block" type="text" value="'.$title.'"/>
                                <input id="id" style="float:left; display:none" type="text" value="'.$id.'"/><br><br>
                                <input type="button" value="Удалить" onclick="delete_product()">
                            </div>
                        </div>
                    </fieldset>';
        $output .= '<div> <input type="button" value="Сохранить" name="Save" onclick="submit_edit();"/>
                    <input type="button" onclick="hide_popup();" value="Отмена"/></div></form>
                    ';

        echo $output;
    }

    function category($id,$title,$db)
    {
        $sql = "select * from products where category_id = {$id}";
        $result = mysqli_query($db->connection, $sql);
        $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $cnt = count($row);
        $list = '';
        
        for($i = 0; $i < $cnt; $i++)
        {
            
            $list .= "<li>{$row[$i]['name']}</li>";
        }
        
        
        $output = '<form action="" method="post"><fieldset class="viewdata">';
        $output .= '<legend>Редактировать категорию</legend>';
        $output .= ' <div>
                            <label>Наименование</label>
                            <div class="panel_input">
                                <input name="Product" id="category_id"  style="float:left; display:block" type="text" value="'.$title.'"/>
                                <input id="id" style="float:left; display:none" type="text" value="'.$id.'"/>
                            </div>
                            <br>
                            <div>
                                <ul>
                                    '.$list.'
                                </ul>
                            </div>
                            <br>
                            <div id="buttons">
                                <input type="button" value="Добавить продукт" onclick="add_product();"><br>
                                <input type="button" value="Создать новый продукт" onclick="create_product();"><br>
                                <input type="button" value="Удалить категорию" onclick="delete_category();"><br>
                            </div>
                            
                        </div>
                    </fieldset>';
        $output .= '<div> <input type="button" value="Сохранить" name="Save" onclick="edit_category();"/>
                    <input type="button" onclick="hide_popup();" value="Отмена"/></div></form>
                    ';

        echo $output;
    }
    
        
    