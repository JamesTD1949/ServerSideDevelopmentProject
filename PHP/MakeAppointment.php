<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                        //connect to DB
    if (isset($_POST['submitdetails'])) {                   
      try { 
        $name = $_POST['pet'];
        $time = $_POST['time'];           //declare variables to store enetered details
        $date = $_POST['date'];
        $procedure = $_POST['procedure'];
        $checkAppointment="SELECT count(*) FROM appointments WHERE date = :date AND time = :time";    //create sql statement to check if appointment is already booked 
    
        $result = $pdo->prepare($checkAppointment);  //prepare sql statement
    
        $result->bindValue(':date', $date);   //bind placeholders to variables
        $result->bindValue(':time', $time); 
    
        $result->execute();    //execute statement
        if($result->fetchColumn() > 0)      //if a row is returned, appointment slot must be booked already, display error message
        {
          include 'header.html';
          echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Sorry, that time slot is already booked. Click<a href='MakeAppointmentForm.php'> here</a> to go back and pick another time</p>";
          include 'footer.html';
        }
        else
        {
          //get petid for selected pets
          include 'header.html';
          $getPetID="SELECT * FROM pets WHERE name = :name";
          $result2 = $pdo->prepare($getPetID);
          $result2->bindValue(':name', $name);
          $result2->execute();
          $row = $result2->fetch();
          $petid = $row['petid'];
          //get procedureid for selected procedure
          $getProcedureID="SELECT * FROM procedures WHERE title = :title";
          $result3 = $pdo->prepare($getProcedureID);
          $result3->bindValue(':title', $procedure);
          $result3->execute();
          $row = $result3->fetch();
          $procedureid = $row['procedureID'];
          //typecast the two id values to int
          $petid = (int)$petid;
          $procedureid = (int)$procedureid;
          //insert date,time,petid and procedureid to appointments table
          $insertAppointment="INSERT INTO appointments (date,time,petid,procedureid,paymentStatus) VALUES (:date,:time,:petid,:procedureid,\"U\")";
          $result4 = $pdo->prepare($insertAppointment);
          $result4->bindValue(':date', $date);
          $result4->bindValue(':time', $time);
          $result4->bindValue(':petid', $petid);
          $result4->bindValue(':procedureid', $procedureid);
          $result4->execute();
          //echo confirmation message  
          echo "<p style=\"color:#000000;padding:5%;border:5px solid green;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Appointment made. We look forward to your visit. Click <a href='homepage.php'>here</a> to return home</p>";
          
          include 'footer.html';
        }//end else
      }//end try
      catch (PDOException $e) { 
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
      }//end catch
  }//end isset 
?>