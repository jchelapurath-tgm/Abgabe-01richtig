<?php
//require("connect.php");
$servername = $_POST['servername'];
$db = $_POST['db'];
$username = $_POST['username'];
$password = $_POST['password'];
try {
   $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
catch(PDOException $e)
   {
   echo "Connection failed: " . $e->getMessage();
   }

   if (isset($_POST['loeschen'])) {
     if (!isset($_POST['m'])) {
       $meldung = 'Bitte markieren Sie den zu l&ouml;schenden Datensatz!' ;
     } else {

       // Markierten Datensatz l�schen
       $sql = 'DELETE FROM passengers WHERE id=' . $_POST['m'];
       $conn->query($sql);

     }
   }

if(isset($_POST['flugnr'])){
  $flightnr = $_POST['flugnr'];
  /*Hier schreibe ich mir die Flugnummer in eine Datei, um sie bei einem Reload der Webseite wieder auszulesen.*/
  $handle = fopen("flughilfe.txt", "w");
  fwrite ($handle, $flightnr);
  fclose ($handle);
}else{
  /*Hier lese ich die Flugnummer aus der Datei aus.*/
  $handle = fopen("flughilfe.txt", "r");
  while( $inhalt = fgets($handle, 4096)){
    $flightnr = $inhalt;
  }
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
         <h2>Flug auswählen</h2>
         <hr>
       </div>
     </div>
       <div class='row'>
         <div class='col-sm-6 text-right'>Bitte wählen Sie Ihre Flugnummer aus: &nbsp;</div>
         <div class='col-sm-6'>
           <select name='flugnr'>
             <?php
             $sql = "SELECT DISTINCT flightnr FROM flights ORDER BY 1";

             foreach($conn->query($sql) as $row) {
               if(isset($flightnr) && $flightnr == $row['flightnr']){
                 echo "<option selected>" . $row['flightnr'] . "</option>";
               }else{
               echo "<option>" . $row['flightnr'] . "</option>";
             }
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
      <h2>Daten zu Ihrem Flug (Flugnummer: <?php if(isset($flightnr)){echo $flightnr;}?>)</h2>
      <hr>
    </div>
  </div>


<?php

  if(isset($flightnr)){
   /*Hier schreibe ich mir die Flugnummer in eine Datei, um sie bei einem Reload der Webseite wieder auszulesen.*/
   $handle = fopen("flughilfe.txt", "w");
   fwrite ($handle, $flightnr);
   fclose ($handle);

   $sql = "SELECT * FROM flights WHERE flightnr = $flightnr";
   echo "<div class='row'><div class='col-sm-2'>Airline</div><div class='col-sm-2'>Abflugszeit</div><div class='col-sm-2'>Abflugsflughafen</div><div class='col-sm-2'>Ankunftszeit</div><div class='col-sm-2'>Ankunftsflughafen</div><div class='col-sm-2'>Flugzeugart</div></div><br>";
   foreach($conn->query($sql) as $row) {
     $output = "<div class='row'><div class='col-sm-2' style='border-right:1px solid black'>". $row['airline'] ."</div>";
     $output .= "<div class='col-sm-2' style='border-right:1px solid black'>". $row['departure_time'] ."</div>";
     $output .= "<div class='col-sm-2' style='border-right:1px solid black'>". $row['departure_airport'] ."</div>";
     $output .= "<div class='col-sm-2' style='border-right:1px solid black'>". $row['destination_time'] ."</div>";
     $output .= "<div class='col-sm-2' style='border-right:1px solid black'>". $row['destination_airport']."</div>";
     $output .= "<div class='col-sm-2'>". $row['planetype'] ."</div></div>";
     echo $output;
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
 <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
   <?php
     if(isset($flightnr)){
     if(isset($meldung)){echo $meldung;}
     $sql = "SELECT * FROM passengers WHERE flightnr = $flightnr ORDER BY 6,7";
     echo "<div class='row'><div class='col-sm-offset-1 col-sm-2'>Reihe</div><div class='col-sm-2'>Sitz</div><div class='col-sm-3'>Nachname</div><div class='col-sm-2'>Vorname</div></div><br>";
     foreach($conn->query($sql) as $row) {

       echo "<div class='row'><div class='col-sm-1'><input type='radio' name='m' value='" . $row['id'] . "'></div><div class='col-sm-2'>" . $row['rownr'] . "</div><div class='col-sm-2'>" . $row['seatposition'] . "</div><div class='col-sm-3'>" . $row['lastname'] . "</div><div class='col-sm-2'>" . $row['firstname'] . "</div><div class='col-sm-2'><input type='submit' id='" . $flightnr . "' name='loeschen' value='L&ouml;schen'></div></div>";
     }
   }
   ?>
   <br>
   </div>
</form>
  </body>
</html>
