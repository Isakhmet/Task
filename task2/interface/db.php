<?php

class Db{
    private static $instance;
    public $connection;
    private $query;
    
    private function __construct()
    {
        $this->getConnection();
    }
    
    public function getInstance()
    {
        return !(static:: $instance instanceof self)? static:: $instance = new self(): static:: $instance;
    }
    
    public function getConnection()
    {
        $this->connection = mysqli_connect('localhost', 'root','root','authorized');
        $this->connection?:die('');
    }
    
    public function setQuery($sql)
    {
        $this->query = $sql;
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }
    
    public function insertQuery($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        
        if ($result == 'TRUE')
        {
            header('Location: welcome.php');
            exit();
        }
        else
        {
            echo "Ошибка! Вы не зарегистрированы.";
        } 
    }
    
    public function escape($string)
    {
        return mysqli_real_escape_string($this->connection, $string);
    }
    
    public function fetch_assoc($result)
    {
        return mysqli_fetch_assoc($result);
    }
    
    public function check($login,$password)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM users WHERE login = '$login'");
        $row = mysqli_fetch_assoc($result);
        
        if (empty($row['password']))
        {
            echo("Извините, введённый вами login или пароль неверный.");
            exit();
        }
        else
        {
            if($row['password']==$password)
            {
                
                header('Location: welcome.php');
                exit();
            }
            else
            {
                echo("Извините, введённый вами login или пароль неверный.");
                exit();
            }
        }
    }
}