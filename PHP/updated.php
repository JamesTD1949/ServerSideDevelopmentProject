<?php
  try {
    session_start();    //create session
    $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                     //connect to DB
    include "updateFunctions.php";   //put input validation into functions in seperate file to reduce amount of code in this file
    if(checkName($_POST['ud_name'])==1){
      if(checkPhone($_POST['ud_phone'])==1){
        if(checkEircode($_POST['ud_eircode'])==1){
          if(checkEmail($_POST['ud_email'])==1){
            if(checkPassword($_POST['ud_password'])==1){
              if($_POST['ud_password']==$_POST['ud_confirmPassword']){  
                $sql = 'update owners set name=:cname,phone = :cphone,eircode = :ceircode,email =  :cemail, password = :cpassword WHERE OwnerID = :cid';   //update statement
                $result = $pdo->prepare($sql);        //prepare statement
                $result->bindValue(':cid', $_POST['ud_id']); 
                $result->bindValue(':cname', $_POST['ud_name']);            //bind placeholders to entered values
                $result->bindValue(':cphone', $_POST['ud_phone']);
                $result->bindValue(':ceircode', $_POST['ud_eircode']);
                $result->bindValue(':cemail', $_POST['ud_email']);
                $result->bindValue(':cpassword', $_POST['ud_password']);
                $result->execute();      
                     
                $count = $result->rowCount();
                if ($count > 0){     //if there's more than 0 affected rows in the result i.e 1 -- then update was successfull
                  include 'header.html';
                  echo "<p style=\"color:#000000;padding:5%;border:5px solid green;width:60%;height:10%;margin:10% auto;border-radius:3%;\">You successfully updated your details!!  click<a href='updateform.php'> here</a> to go back </p>";
                  include 'footer.html';
                }//end if
                else{
                  include 'header.html';
                  echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!!  click<a href='updateform.php'> here</a> to go back </p>";
                  include 'footer.html';
                }//end else
              }//end password match if
              else{
               include 'header.html';
               echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!! Password and confirm password must match!! <br> Click<a href='updateform.php'> here</a> to go back </p>";
               include 'footer.html';
              }
            }//end password format validating if
            else{
             include 'header.html';
             echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!! Password format is incorrect!! Password must be min. 6 characters long, contain at least one letter and number and cannot contain spaces. <br> Click<a href='updateform.php'> here</a> to go back </p>";
             include 'footer.html';
            }
          }//end validating email if 
          else{
           include 'header.html';
           echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!! Email format is incorrect!! click<a href='updateform.php'> here</a> to go back </p>";
           include 'footer.html';
          }
        }//end validating eircode if
        else{
           include 'header.html';
           echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!! Eircode format is incorrect!! click<a href='updateform.php'> here</a> to go back </p>";
           include 'footer.html';
        }
      }//end validating phone number if
      else{
        include 'header.html';
        echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!! Phone number must be 10 digits!! click<a href='updateform.php'> here</a> to go back </p>";
        include 'footer.html';
      }
    }//end validating name if
    else{
       include 'header.html';
        echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">Nothing Updated!! Name can only contain letters and spaces!! click<a href='updateform.php'> here</a> to go back </p>";
        include 'footer.html';
    }
  }//end try 
   
  catch (PDOException $e) { 
  $output = 'Unable to process query sorry : ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
  }//end catch
?>