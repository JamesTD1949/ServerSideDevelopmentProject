<?php  
  session_start();
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Add Pet</title>
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
      
      #contact{color:#000000;
      width:80%;
      margin:2% auto;}
      
      #contact>{margin-left:auto;
                margin-right:auto;}
    </style>
      <?php include 'header.html';
      //create form below similar to make appointment,contains a textfield for pet name,drop down for pet type and a datepicker
      ?>
    </head>
    <body>
      <form id="contact" action="add.php" method="post">
        <h3>Add Pet</h3>
        <h4>Please enter the details of the pet you want to register</h4>
        <fieldset>
            <label for="petName">Name:</label>
            <input required placeholder="Pet Name" type="text" name="petName" style="width:38%;">
        </fieldset>
        <fieldset>
             <label for="type">Pet Type:</label>
             <select name="type" style="width:39%;; margin:1%;">
               <option value="bird">bird</option>
               <option value="cat">cat</option>
               <option value="chicken">chicken</option>
               <option value="cow">cow</option>
               <option value="dog">dog</option>
               <option value="horse">horse</option>
               <option value="lizard">lizard</option>
               <option value="pig">pig</option>
               <option value="rabbit">rabbit</option>
            </select>
        </fieldset>
        <fieldset>
            <label for="dob">Date Of Birth:</label>
            <input required type="date" name="dob" style="width:30%; margin:1%;" max="<?php echo date('Y-m-d');?>">
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" style="width:30%; margin:1% 8%;">Submit</button>
        </fieldset>
      </form>
    <?php include 'footer.html';?>
    </body>
</html>

<!--https://colorlib.com/wp/template/colorlib-contact-form/-->
