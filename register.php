<?php

 $email;
 $pass;
 $repeatedPassword;
 $message = '';

 if(isset($_POST['submit'])){

     if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repeat'])){
        //setting the values to variables 
       
        $email = $_POST['email'];
        $pass = $_POST['password'];

        //checking for special chars to prevent SQL inection, will use PDO also
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //code for valid email adress, hashing password before storing to db
            //$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

            $dsn = "mysql:host=localhost;dbname=quantox-test";
            $user = "root";
            $passwd = "";
            $connectToBase = new PDO($dsn, $user, $passwd);
        
             $check = $connectToBase->prepare('SELECT * FROM users WHERE email= :email');
             $check->bindValue(':email', $email);
             $check->execute();
             $rows = $check->fetchAll(PDO::FETCH_ASSOC);

            if(empty($rows)){
                //there is no username, registration may proceed
                $register = $connectToBase->prepare("INSERT INTO users (email, password) VALUES (:email, :pass)");
                $register->bindValue(':email', $email);
                $register->bindValue(':pass', $pass);
                $register->execute();
                $message = '<p class="message-succes">Succes, you can now Log in</p>';
            }else{
                //display that user exists
                $message = '<p class="message-error">User allready exists</p>';
            }
            


        }else{
            $message = '<p class="message-error">Email allready exists</p>';
            //code for incorect mail
        }
        
         
     }
 }
 require_once 'inc/header.php';
?>
<h1>Welcome to test</h1><br>
<h3>Register</h3>
<?php echo $message ?>
<section class="form-container">
    <form class="login-register" method="POST" action="register.php">

        <label for="email">Enter E-mail adress</label><br>
        <input class="input-field" name="email" placeholder="Enter your email adress" type="email" value="" required/><br>

        <label for="password">Enter password</label><br>
        <input class="input-field" name="password" type="password" placeholder="Enter your password" value="" required/><br>

        <label for="repeat">Repeat password</label><br>
        <input class="input-field" name="repeat" type="password" placeholder="Repeat password" value="" required/><br>

        <input class="submit-button" name="submit" type="submit" value="Register" /><br>

    </form>
</section>
<?php
//including footer
 require_once 'inc/footer.php'
?>