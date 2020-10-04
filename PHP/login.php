<?php
  session_start(); //create session
  
  if (isset($_POST['submitdetails'])) {        //check if button pressed           
    try { 
      $username = $_POST['username'];     //set values entered in form to variable
      $password = $_POST['password'];
  
      $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', '');              //connect to DB
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
      $sql = "SELECT count(*) FROM owners WHERE username=:username AND password=:password";       //check to see how many rows the select statement will return
      
      $stmt = $pdo->prepare($sql);    //prepare the above sql statement
      
      $stmt->bindValue(':username', $username);    //bind placeholders in sql statement to variables declared above
      $stmt->bindValue(':password', $password);
      
      $stmt->execute();      //execute prepared statement
      
      if($stmt->fetchColumn() > 0)      //check to see if the statement returned more than 0 rows -- logically can be a max of one returned since username is unique
      {
        $sql = "SELECT * FROM owners WHERE username=:username AND password=:password";   //select all details of the owner who has the corresponding username and password info
      
        $stmt = $pdo->prepare($sql);   //prepare the above sql statement
        
        $stmt->bindValue(':username', $username);   //bind placeholders in sql statement to variables declared above
        $stmt->bindValue(':password', $password);
        
        $stmt->execute();    //execute prepared statement
        $row = $stmt->fetch();    //get the results of the executed statement
    
        $_SESSION["OwnerID"] = $row['OwnerID'];     //create a session variable to keep track of the logged in user's OwnerID -- will be used on other pages
        header('Location: homepage.php');      //go to homepage
      
      } //end if
      else
      {
          echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:3%;margin:10% auto;border-radius:3%;\">Invalid Username Password Combo!!  click<a href='LoginForm.php'> here</a> to go back </p>";
      }//end else
   
    }//end try
    catch (PDOException $e) { 
        $title = 'An error has occurred';                                                                //catch any errors when attempting to connect to database
        $output = 'Database error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }//end catch 
  }// end if isset 
?> <!-- end file>