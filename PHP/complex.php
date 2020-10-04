<title>Your Pets</title>
<?php
    session_start();               //create session
    include "header.html";
    try { 
      $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                             //connect to DB
      $id = $_SESSION["OwnerID"];            //create id variable to store logged in users OwnerID which is stored in a session variable
      $sql = "SELECT * FROM pets where OwnerID = :id";    //select all pets belonging to the logged in owner
      $result = $pdo->prepare($sql);
      $result->bindValue(":id", $id);           //prepare,bind place holders and execute statement
      $result->execute();
      if($result->fetchColumn() > 0)               //if owner has at least one pet saved in the pet file
      {
          $sql = "SELECT * FROM pets where OwnerID = :id ORDER BY dob";      //select all pets belonging to the logged in owner ordered by dob
          $result = $pdo->prepare($sql);       //prepare,bind place holders and execute statement
          $result->bindValue(":id", $id);  
          $result->execute();
      
      echo "<h3 style=\" margin:5% 40%; color:#000;\">Your Pets</h3>";             //display the returned data in a tabular format
      echo '<table border=1 style="width:60%; margin:5% auto; color:#000; text-align:center"><tr><th style=\"align:center\">Pet ID</th><th style=\"align:center\">Pet Name</th><th style=\"align:center\">Animal Type</th><th style=\"align:center\">Date Of Birth</th><th style=\"align:center\">Owner ID</th></tr>';
      
      while ($row = $result->fetch()) {
            echo '<tr>';
            echo '<td>'.$row['petid'].'</td>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['animalType'].'</td>';
            echo '<td>'.$row['dob'].'</td>';
            echo '<td>'.$row['OwnerID'].'</td>';
            echo '</tr>';
         }//end while
         echo '</table>';
      }//end if
      else {
        echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">You have no pets registered with us!! Click<a href='addform.php'> here</a> to register a pet! </p>";
      }//end else
    }//end try 
    catch (PDOException $e) { 
      $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }//end catch
   include "footer.html";
?> <!--end file>
