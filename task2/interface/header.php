<html>
    <head>
        <meta charset='utf-8'>
        <title>Welcome</title>
        <script src="js/ajax.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
        
    </head>
    
    <body>
        
<?php
     
    if($_SESSION['authorized'] ?? false)
    {
        ?>
        <header>
            <div id="login">
                
            <label> <?=$_SESSION['login'] ?></label>
            </div>
            <div id="logout">
                <form method="post" >
                    <input type="submit" name="logout" value="Logout">
                </form>
            </div>
        </header>
        <br>
        <br>
        <br>
        
        <?php
    }
?>