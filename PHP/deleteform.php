<?php session_start();?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Delete Pet</title>
    <meta charset='utf-8'>
    <meta name='description' content=''>
    <meta name='keywords' content=''>
    <meta name='author' content=''>
    <meta name='robots' content='all'>
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
        margin: 150px 0;
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
      
      #contact input[type="text"],
      #contact input[type="email"],
      #contact input[type="tel"],
      #contact input[type="url"],
      #contact textarea {
        width: 100%;
        border: 1px solid #ccc;
        background: #FFF;
        margin: 0 0 5px;
        padding: 10px;
        z-index:1;
      }
      
      #contact input[type="text"]:hover,
      #contact input[type="email"]:hover,
      #contact input[type="tel"]:hover,
      #contact input[type="url"]:hover,
      #contact textarea:hover {
        -webkit-transition: border-color 0.3s ease-in-out;
        -moz-transition: border-color 0.3s ease-in-out;
        transition: border-color 0.3s ease-in-out;
        border: 1px solid #aaa;
      }
      
      #contact textarea {
        height: 100px;
        max-width: 100%;
        resize: none;
      }
      
      #contact button[type="submit"] {
        cursor: pointer;
        width: 100%;
        border: none;
        background: #4CAF50;
        color: #FFF;
        margin: 0 0 5px;
        padding: 10px;
        font-size: 15px;
      }
      
      #contact button[type="submit"]:hover {
        background: #43A047;
        -webkit-transition: background 0.3s ease-in-out;
        -moz-transition: background 0.3s ease-in-out;
        transition: background-color 0.3s ease-in-out;
      }
      
      #contact button[type="submit"]:active {
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
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
      
      #contact{color:#000;
               width:60%;
               margin-left:auto;
               margin-right:auto;}
      
      #submit{width:30%;}
  </style>
  </head>
  <body>
  <?php
    <?php
    session_start();          //create session
    $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            //connect to DB
    $id = $_SESSION["OwnerID"];
    $sql = "SELECT count(*) FROM pets WHERE OwnerID= :id";     //retrieve how many pets the logged in user has
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id); 
    $stmt->execute();

    if($stmt->fetchColumn() > 0)
    {
      include 'header.html'; ?>
      <form id="contact" action="delete.php" method="post">
        <h3>Delete Pet</h3>
        <h4>Please select the pet you want to delete</h4>
        <fieldset>
          <label for="pet">Desired Pet:</label>
          <select name="pet">;
                  <?php
                    //select and put the user's pets into the drop down
                    $sql = "SELECT * FROM pets WHERE OwnerID= :id";
                    $stmt = $pdo->prepare($sql);
                  
                    $stmt->bindValue(':id', $id); 
                    $stmt->execute();
                    while ($row = $stmt->fetch()) { 
                      echo "<option>";
                      echo $row['name'];
                      echo "</option>";
                    }
                 ?>
          </select>
        </fieldset>
          <button name="submit" type="submit" id="submit" data-submit="...Sending" style="width:34%; margin-top:2%;">Submit</button>
        </fieldset>
      </form>
  <?php include 'footer.html'
    }
    else{
      include 'header.html';
      echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">You have no pets registered with us!! You can't delete a pet!!  click<a href='addform.php'> here</a> to register a pet! </p>";
      include 'footer.html';
    };?>
  </body>
</html>


<!--https://colorlib.com/wp/template/colorlib-contact-form/-->
