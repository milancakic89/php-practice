<?php
session_start();
$message = "";
$showResult = false;
$users;
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
    
 if(isset($_POST['searching'])){

    if(isset($_POST['search'])){
       //setting the values to variables 
      
       $search = $_POST['search'];

       //checking for special chars to prevent SQL inection, will use PDO also
       if(filter_var($search, FILTER_VALIDATE_EMAIL)){


           $dsn = "mysql:host=localhost;dbname=quantox-test";
           $user = "root";
           $passwd = "";
           $connectToBase = new PDO($dsn, $user, $passwd);
       
            $check = $connectToBase->prepare('SELECT * FROM users WHERE email= :email');
            $check->bindValue(':email', $search);
            $check->execute();
            $rows = $check->fetchAll(PDO::FETCH_ASSOC);

           if(empty($rows)){
               //there is no username, registration may proceed
               $message = '<p class="message-error">No result for that user in database, try other email</p>';
           }else{
               //display that user exists
               $showResult = true;
               $message = '<p class="message-succes">Congrats: your results</p><br>';

           }
           


       }else{
           $message = '<p class="message-error">Email allready exists</p>';
           //code for incorect mail
       }
       
        
    }
}
    
} else {
    $message = '<p class="message-error">Login first!</p>';
}
?>
<?php require_once 'inc/header.php';  ?>
    <h1>Results<h1>
        <?php echo $message; ?>
 <section class="results-page">
    <?php 
    if($showResult === true){
        foreach($rows as $row){
            echo '<article class="result-article"><p>User: '.$row['email'].' exists in database</p></article>';
          }
    }
    
     ?>
 </section>       
<?php require_once 'inc/footer.php';  ?>