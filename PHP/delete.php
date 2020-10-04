<?php
  session_start();
  $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_POST['submit'])) { 
    try { 
      $id = $_SESSION["OwnerID"];
      $checkExist = 'SELECT count(*) FROM pets WHERE name = :name AND OwnerID = :id';
      $result = $pdo->prepare($checkExist);
      $result->bindValue(':name', $_POST['pet']);
      $result->bindValue(':id', $id);
      $result->execute();      //selects the pet with the specified name that belongs to the logged in user
      if($result->fetchColumn() == 1) //if it returns one row -- continue on with delete pet
      {
          $retrieve = 'SELECT * FROM pets WHERE name = :name AND OwnerID = :id';
          $result2 = $pdo->prepare($retrieve);
          $result2->bindValue(':name', $_POST['pet']);
          $result2->bindValue(':id', $id); 
          $result2->execute();
          while ($row = $result2->fetch()) {
              include 'header.html';                             //create table to contain selected pets information
              echo "<h3 style=\" margin:5% 40%; color:#000;\">Delete This Pet?</h3>";
              echo '<table border=1 style="width:60%; margin:5% auto; color:#000; text-align:center"><tr><th style=\"align:center\">Pet Name</th><th style=\"align:center\">Animal Type</th><th style=\"align:center\">Date Of Birth</th></tr>';
     
              echo '<tr>';
              echo '<td>'.$row['name'].'</td>';
              echo '<td>'.$row['animalType'].'</td>';
              echo '<td>'.$row['dob'].'</td>';
              echo '</tr>';
              echo '</table>'; 
              echo $row['petid'];              //create form to contain confirm button and hidden field that will pass petid to deletepet
      	      echo "<form action=\"deletepet.php\" method=\"post\">
                  <input type=\"hidden\" name=\"petid\" value=$row[petid]>
                  <input type=\"hidden\" name=\"name\" value=$row[name]>
                  <input id=\"submit\" type=\"submit\" value=\"Delete\" name=\"delete\" style=\" margin: 0% 0% 4% 40%; cursor: pointer; width: 20%; border: none; background: #4CAF50; color: #FFF; padding: 10px; font-size: 15px; font: 400 12px/16px Roboto, Helvetica, Arial, sans-serif; background-color:green; color:black;\">
              </form>";
              echo $row['petid'];
              include 'footer.html';
                    }//end while
      }//end if
      else if($result->fetchColumn() == 0) {
            print "No rows matched the query.";
      }//end else if
      else{
        print "This message shouldn't be seen -- Only appear if Owner has two pets with same name -- prevent that with input validation on add pet";
      }//end else
    }//end try 
    catch (PDOException $e) { 
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }//end catch
  }//end if
?>
