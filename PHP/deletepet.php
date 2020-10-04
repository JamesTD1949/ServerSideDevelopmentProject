<?php
  try {
    session_start();
    include 'header.html';
    $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'DELETE FROM pets WHERE petid = :petid';
    $result = $pdo->prepare($sql);
    $result->bindValue(':petid', $_POST['petid']); 
    $result->execute();
    echo "<p style=\"color:#000000;padding:5%;border:5px solid green;width:60%;height:10%;margin:10% auto;border-radius:3%;\">You just deleted " . $_POST['name']. ". Click <a href='homepage.php'>here</a> to return home</p>";
          
  }//end try 
  catch (PDOException $e) { 
    if ($e->getCode() == 23000) {  //enforce referential integrity through if statement -- due to time constraints there is no delete appointment or ability to delete pets who only have past appointments
              echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Cannot delete this pet as it has appointments in the appointments table. Only pets who haven't attended the clinic can be deleted. Click<a href='deleteform.php'> here</a> to go back </p>";
    
         }//end if
    include 'footer.html';
  }//end catch 
?>
