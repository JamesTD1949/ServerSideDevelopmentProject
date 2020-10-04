<title>Booked Appointments</title>
<?php 
    include "header.html";
    try { 
      $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', '');     //connect to DB
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = 'SELECT date,time FROM appointments';
      $result = $pdo->prepare($sql);                     //define, prepare and execute query
      $result->execute();
      if($result->fetchColumn() > 0)   //check if query returned at least one row
      {
        $sql = 'SELECT date,time FROM appointments ORDER BY date';            //return the date and time of every appointment in the system ordered from oldest to farthest in the future
        $result = $pdo->prepare($sql); 
        $result->execute();
        echo "<h3 style=\" margin:5% 40%; color:#000;\">Booked Appointments</h3>";          //create table to display the retrieved information in a neat format
        echo '<table border=1 style="width:60%; margin:5% auto; color:#000; text-align:center"><tr><th style=\"align:center\">Date</th><th style=\"align:center\">Time</th></tr>';
      
        while ($row = $result->fetch()) {
          echo '<tr>';
          echo '<td>'.$row['date'].'</td>';       //add the date and time from every returned row to the table
          echo '<td>'.$row['time'].'</td>';
          echo '</tr>';
          }//end while
        echo '</table>';    //close table
      }//end if
      else {
        //display basic error statemtent if there are no appointments in the appointments table
        echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">There are no appointments in the table!! Click<a href='MakeAppointmentForm.php'> here</a> to make an appointment.</p>";
      }//end else
    }//end try 
    catch (PDOException $e) { 
      $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }//end catch
    
   include "footer.html" 
?><!--end file>