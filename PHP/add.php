<?php
  session_start();   //create session
  if (isset($_POST['submit'])) {         //check if submit button was pressed          
  try {
      $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', '');     //connect to DB
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      include 'addFunction.php';
      $id = (int)$_SESSION['OwnerID'];     //declare variable id and set its value to the logged in user's OwnerID
      $petName = $_POST['petName'];        //declare variables to store the values entered on the form
      $type = $_POST['type'];
      $dob = $_POST['dob'];
      $date = date("Y/m/d");
      if(nameCheck($petName)==1){
          $sql = "SELECT * FROM pets WHERE name = :name && OwnerID = :id";  //statement to select all pets with the entered name that belong to the logged in user
          $stmt = $pdo->prepare($sql);    //prepare statement
          $stmt->bindValue(':name', $petName);    //bind placeholders to variables declared above
          $stmt->bindValue(':id', $id);
          $stmt->execute();   //execute insert statement
          if($stmt->fetchColumn() == 0)   //Only allow pet to be added if the owner doesn't have one with the same name -- this was done for the delete/Make Appointment form to displays the names of the pets without allowing multiples of the same names appear
          { 
            $sql = "INSERT INTO pets (name,animalType,dob,OwnerID) VALUES (:petName,:animalType,:dob,:OwnerID)";  //statement to insert entered details into pet table -- don't have to declare petid as it's auto-increment
            $stmt = $pdo->prepare($sql);    //prepare statement
            $stmt->bindValue(':petName', $petName);    //bind placeholders to variables declared above
            $stmt->bindValue(':animalType', $type);
            $stmt->bindValue(':dob', $dob);
            $stmt->bindValue(':OwnerID', $id);
            
            $stmt->execute();   //execute insert statement
            //output basic success message with header and footer attatched to keep consistent look
            include 'header.html';
            echo "<p style=\"color:#000000;padding:5%;border:5px solid green;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Pet Successfully added to the System!! Click<a href='MakeAppointmentForm.php'> here</a> to book an appointment for this pet ! </p>";
            include 'footer.html';
          }
          else{
            include 'header.html';
            echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Pet not added!! You cannot add multiple pets with the same name!! click<a href='addform.php'> here</a> to go back </p>";
            include 'footer.html';
          }
      }//end validation if
      else{
        include 'header.html';
        echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Pet not added!! Pet name can only contain letters!! click<a href='addform.php'> here</a> to go back </p>";
        include 'footer.html';
      }//end validation else
  }//end try
  catch (PDOException $e) {                 //catch any errors when connecting to database
      $title = 'An error has occurred';
      $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
  }//end catch 
  }//end if isset  
?> <!-- end file-->

