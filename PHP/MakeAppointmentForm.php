<!DOCTYPE html>
<html lang='cs'>
  <head>
    <title>Make Appointment</title>
    <meta charset='utf-8'>
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
    width:80%;}
  </style>
</head>
<body>
  <!-- HTML and CSS for the forms was taken from >> https://colorlib.com/wp/template/colorlib-contact-form/-->
  <?php
    session_start();          //create session
    $pdo = new PDO('mysql:host=localhost;dbname=veterinary; charset=utf8', 'root', ''); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            //connect to DB
    $id = $_SESSION["OwnerID"];
    $sql = "SELECT count(*) FROM pets WHERE OwnerID= :id";     //retrieve how many pets the logged in user has
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id); 
    $stmt->execute();

    if($stmt->fetchColumn() > 0)    //if user has at least one pet then display form
    {
      include 'header.html'; ?>
      <form id="contact" action="makeAppointment.php" method="post">     <!--create form that will post to makeAppointment.php-->
        <h3>Book Appointment</h3>
        <h4>Please complete the form below</h4>
          <fieldset>
            <label for="date">Desired Date:</label>                <!--create datepicker with a minimum of today's date i.e. can't book an appointment in the past-->
            <input type="date" id="date" name="date" title="Choose your desired date" min="<?php echo date('Y-m-d');?>"/>
          </fieldset>
          <fieldset>                        <!--Create a drop down to select time for appointment -- due to time constraints I hardcoded these in as opposed to having an AppTimes table-->
            <label for="time">Desired Time:</label> 
            <select name="time" style="width:30%; margin:1%;">
               <option value="09:00">09:00</option>
               <option value="09:30">09:30</option>
               <option value="10:00">10:00</option>
               <option value="10:30">10:30</option>
               <option value="11:00">11:00</option>
               <option value="11:30">11:30</option>
               <option value="13:00">13:00</option>
               <option value="13:30">13:30</option>
               <option value="14:00">14:00</option>
               <option value="14:30">14:30</option>
               <option value="15:00">15:00</option>
               <option value="15:30">15:30</option>
               <option value="16:00">16:00</option>
               <option value="16:30">16:30</option>
            </select>
          </fieldset>
          <fieldset>                       <!--Create a drop down to select pet-->
            <label for="pet">Desired Pet:</label>
            <select name="pet">;
              <?php
                $sql = "SELECT * FROM pets WHERE OwnerID= :id";
                $stmt = $pdo->prepare($sql);
              
                $stmt->bindValue(':id', $id); 
                $stmt->execute();
                while ($row = $stmt->fetch()) { 
                  echo "<option>";               //use select to retrieve owners pets and then make each of them an option in the drop down
                  echo $row['name'];
                  echo "</option>";
                }
              ?>
            </select>
          </fieldset>
          <fieldset>
            <label for="procedure">Desired Procedure:</label>
            <select style="color:#000" name="procedure" style="width:30%; margin:1%;">
              <?php
                $sql = "SELECT title FROM procedures";
                $stmt = $pdo->prepare($sql); 
                $stmt->execute();                   //use select to retrieve procedures and then make each of them an option in the drop down
                while ($row = $stmt->fetch()) { 
                  echo "<option>";
                  echo $row['title'];
                  echo "</option>";
                }
              ?>
            </select>
          </fieldset>
          <input type="submit" name="submitdetails" value="Make Appointment" style="width:30%; margin:1% auto;">
      </form>
      <?php include 'footer.html';
    }//end if
      else
      {                                         //display basic error message if Owner has no saved pets
                                                //due to time constraints I assumed that there will always be procedures in the procedures table
        include 'header.html';
        echo "<p style=\"color:#000000;padding:5%;border:5px solid red;width:60%;height:10%;margin:10% auto;border-radius:3%;\">You have no pets registered with us!! You can't make an appointment!!  click<a href='addform.php'> here</a> to register a pet! </p>";
        include 'footer.html';
      }
?>
</body>
</html>


