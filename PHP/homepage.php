<!DOCTYPE html>
  <html lang="en">
  <head>
    <?php
      session_start();
    ?>
    <!-- Theme Made By W3Schools >> https://www.w3schools.com/bootstrap/bootstrap_theme_me.asp -->
    <title>Bootstrap Theme Simply Me</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Homepage.css">
  </head>
  <body>
    <?php include 'header.html'?>
    <!-- First Container -->
    <div class="container-fluid bg-1 text-center">
      <h3 class="margin">Who Are We?</h3>
      <img src="homepage.jpg" class="img-responsive img-circle margin" style="display:inline" alt="Vet_Logo" width="300" height="300">
      <h3>Vitaliti Vet</h3>
      <h4>Your local Veterinary Clinic</h4>
    </div>
    <?php include 'footer.html'?>
    
  
  </body>
</html>
