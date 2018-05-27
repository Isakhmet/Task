function insert_category(){
    
    var name = $('#category_id').val();
    var insert_category = true;
    

    $.ajax({
            url: 'data.php',
            method: 'POST',
            data: {name,insert_category},
            success: function(data)
            {
                alert(data);
                hide_popup();
                location.reload();
            }
        })
}

function form_category(){
    
    var create_category = true;
    
    $.ajax({
        url: 'edit.php',
        method: 'POST',
        data: {create_category},
        success: function(data){
            $('.product_window').html(data);
            $('.product_window').animate({'opacity': 'show'});
        },
        error: function(m, e){
            alert(m.statusText);
        }
    })
}

function delete_category(){
    
    var id = $('#id').val();
    var delete_category = true;
    //alert(id);
    $.ajax({
            url: 'data.php',
            method: 'POST',
            data: {id,delete_category},
            success: function(data)
            {
                hide_popup();
                location.reload();
            }
        })
}

function insert_product(){
    
    var name = $('#product_id').val();
    var insert = true;
    var id = $('#id').val();

    $.ajax({
            url: 'data.php',
            method: 'POST',
            data: {name,insert,id},
            success: function(data)
            {
                hide_popup();
                location.reload();
            }
        })
}

function create_product(){
    
    var create_product = true;
    var parent_id = $('#id').val();
    $.ajax({
        url: 'edit.php',
        method: 'POST',
        data: {create_product,parent_id},
        success: function(data){
            $('.create_window').html(data);
            $('.create_window').animate({'opacity': 'show'}, 500);
            
        },
        error: function(m, e){
            alert(m.statusText);
        }
    })
}

function delete_product(){
    
    var id = $('#id').val();
    var delete_product = true;

    $.ajax({
            url: 'data.php',
            method: 'POST',
            data: {id,delete_product},
            success: function(data)
            {
                hide_popup();
                location.reload();
            }
        })
}

function edit_category(){
    
    var category_name = $('#category_id').val();
    var id = $('#id').val();
    var update_category = true;
    
    if(category_name == '')
    {
        alert('Заполните поле Найменования');
    }
    else{
        $.ajax({
            url: 'data.php',
            method: 'POST',
            data: {id,category_name,update_category},
            success: function(data)
            {
                hide_popup();
                location.reload();
            }
        })
    }
}

function submit_product(){
    
    var product_name = $('#product_name').val();
    var parent_id = $('#id').val();
    var add_product = true;
    
    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {parent_id,product_name,add_product},
        success: function(data)
        {
            alert(data);
            hide_popup();
            location.reload();
        }
    })
    
}

function add_product(){
    
    var category_id = $('#id').val();
    
    
    $.ajax({
        url: 'edit.php',
        method: 'POST',
        data: {category_id},
        success: function(data){
            $('.product_window').html(data);
            $('.product_window').animate({'opacity': 'show'});
        },
        error: function(m, e){
            alert(m.statusText);
        }
    })
}

function popup_ajax(url)
{
    var index_id = url.lastIndexOf('/');
    var index_name = url.indexOf('/');
    var index_type = url.indexOf('/', index_name + 1);
    var type = url.substring(index_type+1,index_id);
    //alert(qwerty);
    var product = url.substring(index_name + 1,index_type);
    var product_id = url.substring(index_id + 1);
    
    $.ajax({
        url: url,
        method: 'POST',
        data: {product_id,product,type},
        success: function(data){
            $('.popup_window').html(data);
            $('.popup_window').animate({'opacity': 'show'}, 500);
            
        },
        error: function(m, e){
            alert(m.statusText);
        }
    })
}



function hide_popup(){
    $('.popup_window').animate({'opacity' : 'hide'}, 500);
}

function hide_product(){
    $('.create_window, .product_window').animate({'opacity' : 'hide'}, 500);
}

function submit_edit(){
    
    var value = 0;
    var id;
    value = $('#product_id').val();
    id = $('#id').val();
    update_product = true;
    
    if(value == '')
    {
        alert('Заполните поле Найменования');
    }
    else{
        $.ajax({
            url: 'data.php',
            method: 'POST',
            data: {id,value,update_product},
            beforeSend: function(){
        },
            success: function(data)
            {
                hide_popup();
                location.reload();
            }
        })
    }
}

