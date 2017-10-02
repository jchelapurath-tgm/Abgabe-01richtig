<?php
require("connect.php");



try {
   $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
catch(PDOException $e)
   {
   echo "Connection failed: " . $e->getMessage();
   }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Flugticket - Manager</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>


<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <div class='container'style='margin-top: 25px'>
     <div class='row text-center'>
       <div class='col-sm-12'>
         <h2>Schritt 1: Flug auswählen</h2>
         <hr>
       </div>
     </div>
       <div class='row'>
         <div class='col-sm-6 text-right'>Bitte wählen Sie Ihre Flugnummer aus: &nbsp;</div>
         <div class='col-sm-6'>
           <select name='flugnr'>
             <option value="" default>---</option>
             <?php
             $sql = "SELECT DISTINCT flightnr FROM flights ORDER BY 1";
             foreach($conn->query($sql) as $row) {
               echo "<option>" . $row['flightnr'] . "</option>";
             }
             ?>
           </select>
         </div>
       </div>
       <br>
       <div class='row text-center'>
         <div class='col-sm-12 text-center'>
           <input type='submit' value='Suchen'>
           <input type='hidden' value='1' name='flug' />
         </div>
       </div>
</form>
       </div>

<br>


<div class="container-fluid text-center"style='margin-top: 25px'>
  <div class="row text-center">
    <div class="col-sm-12">
      <h2>Schritt 2: Daten zu Ihrem Flug</h2>
      <hr>
    </div>
  </div>


<?php

if(isset($_POST['flug'])){
  global $conn;
   $flightnr = $_POST['flugnr'];
   $sql = "SELECT * FROM flights WHERE flightnr = $flightnr";
   echo "<div class='row'><div class='col-sm-2'>Airline</div><div class='col-sm-2'>Abflugszeit</div><div class='col-sm-2'>Abflugsflughafen</div><div class='col-sm-2'>Ankunftszeit</div><div class='col-sm-2'>Ankunftsflughafen</div><div class='col-sm-2'>Flugzeugart</div></div><br>";
   foreach($conn->query($sql) as $row) {
     echo "<div class='row'><div class='col-sm-2' style='border-right:1px solid black'>". $row['airline'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['departure_time'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['departure_airport'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['destination_time'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['destination_airport'] ."</div><div class='col-sm-2'>". $row['planetype'] ."</div></div>";
   }
   echo "</div>";
}
?>
<div class='container text-center'style='margin-top: 25px'>
 <div class='row text-center'>
   <div class='col-sm-12'>
     <h2>Personen auf diesem Flug</h2>
     <hr>
   </div>
 </div>
   <?php
     $sql = "SELECT * FROM passengers WHERE flightnr = $flightnr ORDER BY 6,7";
     echo "<div class='row'><div class='col-sm-3'>Reihe</div><div class='col-sm-3'>Sitz</div><div class='col-sm-3'>Nachname</div><div class='col-sm-3'>Vorname</div></div><br>";
     foreach($conn->query($sql) as $row) {

       echo "<div class='row'><div class='col-sm-3'>" . $row['rownr'] . "</div><div class='col-sm-3'>" . $row['seatposition'] . "</div><div class='col-sm-3'>" . $row['lastname'] . "</div><div class='col-sm-3'>" . $row['firstname'] . "</div></div>";
     }
   ?>
   <br>
   </div>

  </body>
</html>
