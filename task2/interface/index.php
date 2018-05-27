<?php
     session_start();
     function autoload($class)
     {
         require_once(strtolower($class).'.php');
     }
        
    spl_autoload_register('autoload');

    $db = Db::getInstance();
    
    //die(var_dump($_SESSION['authorized']));

    if(isset($_POST['enter']))
    {
        $login = $db->escape($_POST['login']);
        $password = $db->escape($_POST['password']);
        if (empty($login) or empty($password))
        {
            echo ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
            exit();
        }
        else
        {
            $_SESSION['authorized'] = true;
            $_SESSION['login'] = $login;
        }
        $db->check($login,$password);
        
        
    }
    include 'header.php';
?>

<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
    
    <p><strong>Login</strong>:</p>
    <input type="text" name="login">
    
    <p><strong>Password</strong>:</p>
    <input type="password" name="password">
    <br/>
    <br/>
    <input id="enter" type="submit" name="enter" value="Войти">
    <br/>
    <br/>
    <a href="register.php"> Registration</a>
    
</form>
<?php include 'footer.html';?>
    

 