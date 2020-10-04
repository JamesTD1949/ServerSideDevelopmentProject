<!DOCTYPE html>
<html lang='en'>
  <head>
      <title>Update Your Details</title>
      <link rel="stylesheet" type="text/css" href="Homepage.css">
      <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          -webkit-font-smoothing: antialiased;
          -moz-font-smoothing: antialiased;
          -o-font-smoothing: antialiased;
          text-rendering: optimizeLegibility;
        }
        
        
        
        .containerForm {
          max-width: 400px;
          width: 100%;
          margin: 0 auto;
          position: relative;
          background-color: #1abc9c; /* Green */
          color: #ffffff;
        }
        
        #contact input[type="text"],
        #contact input[type="email"],
        #contact input[type="tel"],
        #contact input[type="url"],
        #contact textarea,
        #contact button[type="submit"] {
          font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
        }
        
        #contact {
          background: #F9F9F9;
          padding: 25px;
          margin: 10% auto;
          box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        
        #contact h3 {
          display: block;
          font-size: 30px;
          font-weight: 300;
          margin-bottom: 10px;
          color: #000000;
        }
        
        #contact h4 {
          margin: 5px 0 15px;
          display: block;
          font-size: 13px;
          font-weight: 400;
          color: #000000;
        }
        
        fieldset {
          border: medium none !important;
          margin: 0 0 10px;
          min-width: 100%;
          padding: 0;
          width: 100%;
        }
        
        #contact input[type="text"]{
          width: 100%;
          border: 1px solid #ccc;
          background: #FFF;
          margin: 0 0 5px;
          padding: 10px;
        }
        
        #contact input[type="text"]:hover{
          -webkit-transition: border-color 0.3s ease-in-out;
          -moz-transition: border-color 0.3s ease-in-out;
          transition: border-color 0.3s ease-in-out;
          border: 1px solid #aaa;
        }
        
        #contact input[type="submit"] {
          cursor: pointer;
          width: 100%;
          border: none;
          background: #4CAF50;
          color: #FFF;
          margin: 0 0 5px;
          padding: 10px;
          font-size: 15px;
        }
        
        #contact input[type="submit"]:hover {
          background: #43A047;
          -webkit-transition: background 0.3s ease-in-out;
          -moz-transition: background 0.3s ease-in-out;
          transition: background-color 0.3s ease-in-out;
        }
        
        
        .copyright {
          text-align: center;
        }
        
        #contact input:focus,
        #contact textarea:focus {
          outline: 0;
          border: 1px solid #aaa;
        }
        
        ::-webkit-input-placeholder {
          color: #888;
        }
        
        :-moz-placeholder {
          color: #888;
        }
        
        ::-moz-placeholder {
          color: #888;
        }
        
        :-ms-input-placeholder {
          color: #888;
        }
        
        #contact{color:#000000;
        width:80%;};
      </style>
      <?php
      session_start();
      try { 
        $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $id = (int)$_SESSION["OwnerID"];
        
        $sql="SELECT count(*) FROM owners WHERE OwnerID= :id";
        
        $result = $pdo->prepare($sql);
        
        $result->bindValue(':id', $id); 
        
        $result->execute();
        if($result->fetchColumn() > 0) 
        {
            $sql = "SELECT * FROM owners where OwnerID = :id";
            $result = $pdo->prepare($sql); 
            $result->bindValue(':id', $id); 
            
            $result->execute();
        
            $row = $result->fetch() ;     //fetch the logged in users current info to place into the form.
            $id = $row['OwnerID'];
        	  $name= $row['Name'];
        	  $phone=$row['phone'];
            $eircode=$row['eircode'];
            $email=$row['email'];
            $password=$row['password'];   
        }//end if
        
        else {
              print "No rows matched the query. try again click<a href='selectupdate.php'> here</a> to go back";
            }//end else
      }//end try 
      catch (PDOException $e) { 
      $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
      }//end catch     
      ?>
  </head>
  <body>
      <?php include 'header.html';?>
      <form id="contact" action="updated.php" method="post">
          <input required type="hidden" name="ud_id" value="<?php echo $id; ?>">
          <label for="ud_name">Name:</label>
          <input required type="text" name="ud_name" value="<?php echo $name; ?>">
          <label for="ud_phone">Phone Number:</label>
          <input required type="text" name="ud_phone" value="<?php echo $phone; ?>">
          <label for="ud_eircode">Eircode:</label>
          <input required type="text" name="ud_eircode" value="<?php echo $eircode; ?>">
          <label for="ud_email">Email:</label>
          <input required type="text" name="ud_email" value="<?php echo $email; ?>">
          <label for="ud_password">Password:</label>
          <input required type="text" name="ud_password" value="<?php echo $password; ?>">
          <label for="ud_confirmPassword">Confirm Password:</label>
          <input required type="text" name="ud_confirmPassword" value="<?php echo $password; ?>">
          <input type="Submit" value="Update">
      </form>
      <?php include 'footer.html';?>
  </body>
  </html>
