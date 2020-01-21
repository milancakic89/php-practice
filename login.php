<?php 
session_start();
$message = "";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $message = '<p class="message-succes">You are allredy logged in ' . $_SESSION['email'] . "!</p>";
} else {
    
 $email;
 $pass;
 $message = '';

 if(isset($_POST['submit'])){

     if(isset($_POST['email']) && isset($_POST['password'])){
        //setting the values to variables 
        $email = $_POST['email'];
        $pass = $_POST['password'];

        //checking for special chars to prevent SQL inection, will use PDO also
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            //code for valid email adress, hashing password before storing to db
           // $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
           // echo $hashedPass;
            $dsn = "mysql:host=localhost;dbname=quantox-test";
            $user = "root";
            $passwd = "";
            $connectToBase = new PDO($dsn, $user, $passwd);
        
             $check = $connectToBase->prepare('SELECT * FROM users WHERE email = :email AND password = :pass');
             $check->bindValue(':email', $email);
             $check->bindValue(':pass', $pass);
             $check->execute();
             $rows = $check->fetchAll(PDO::FETCH_ASSOC);

            if(empty($rows)){
                //there is no username, throw and error on screen
                print_r($rows);
                $message = '<p class="message-succes">Username not found, check input fields</p>';
            }else{
                $_SESSION['loggedin'] = true;
               $_SESSION['email'] = $email;
                //saying hello to new user
                $message = '<p class="message-succes">Welcome '.$email.'</p>';
            }
            


        }else{
            $message = '<p class="message-error">Email allready exists</p>';
            //code for incorect mail
        }
        
         
     }
 }

}

?>
<?php require_once 'inc/header.php'?>
<h1>Welcome to test</h1><br>
<h3>Login</h3>
<?php echo $message ?>
<section class="form-container">
    <form class="login-register" method="POST" action="login.php">

        <label for="email">E-mail adress</label><br>
        <input class="input-field" name="email" placeholder="Enter your email adress" type="email" value="" required/><br>

        <label for="password">Password</label><br>
        <input class="input-field" name="password" type="password" placeholder="Enter your password" value="" required/><br>

        <input class="submit-button" name="submit" type="submit" value="Login" /><br>

    </form>
</section>
<?php require_once 'inc/footer.php'?>