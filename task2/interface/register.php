<?php
    session_start();
        
    function autoload($class){
        require_once(strtolower($class).'.php');
    }

    spl_autoload_register('autoload');
    $db= Db::getInstance();
    
    if (isset($_POST['submit']))
    {
        
        $login = $db->escape($_POST['login']);
        $password = $db->escape($_POST['password']);
        $confirm_password = $db->escape($_POST['cpassword']);
        $reg = new Reg($login, $password, $confirm_password);
        
        if (empty($reg->login) or empty($reg->password) or empty($reg->confirm_password))
        {
            echo ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
            exit();
        }
        else
        {
            $_SESSION['authorized'] = true;
        }
        
        $reg->quality($reg->password, $reg->confirm_password);
        $result = $db->setQuery("SELECT id FROM users WHERE login= '{$reg->login}'");
        $row = $db->fetch_assoc($result);
        $reg->unique($row);
        $res = $db->insertQuery("INSERT INTO users (login,password) VALUES('{$reg->login}','{$reg->password}')");
    }
    include 'header.php';
?>

<form action="<?= $_SERVER['PHP_SELF']?>" method="post">

    <label><p>Login</p><input type="text" name="login"></label>
    <br/>
    <label><p>Password</p><input type="password" name="password"></label>
    <br/>
    <label><p>Confirm password</p><input type="password" name="cpassword"></label>
   
    <br/>
    <br/>
    <input id="enter" type="submit" name="submit">
    
</form>
<?php include 'footer.html';?>