<?php

class Reg extends Users{
    
    public $confirm_password;
    
    public function __construct($login,$password,$confirm_password){
        $this->login = $login;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        
        $_SESSION['login'] = $login;
    }
    
    public function __construct(){
        
    }
    
    public function quality($one, $two){
        if ($one != $two)
        {
            echo ('Пароли не совпадают');
            exit;
        }
    }
    
    
    public function unique($row){
        if (!empty($row['id'])){
            echo('Извините, введённый вами логин уже зарегистрирован. Введите другой логин.');
            exit;
        }
    }
        
}    
