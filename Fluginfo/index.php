<?php

$servername = 'localhost';
$username = 'test';
$password = '1234';
$db = 'flugdaten';

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

<!--
    <div class="container" style='margin-top: 15px'>
      <div class="row text-center">
        <div class="col-sm-12">
          <h2>Schritt 1: Datenbankdaten</h2>
          <hr>
        </div>
      </div>

<form action="" method="post">
        <div class="row">
          <div class="col-sm-6 text-right">
            Datenbankserver:&nbsp;
          </div>
          <div class="col-sm-6">
            <select name="srv">
              <option value="localhost">Localhost</option>
              <option value="MySQL">MySQL</option>
              <option value="PostGres">PostgreSQL</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 text-right">
            Datenbank:&nbsp;
          </div>
          <div class="col-sm-6">
            <input type="text" name="db"value="Flugdaten" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 text-right">
            Username:&nbsp;
          </div>
          <div class="col-sm-6">
            <input type="text" name="user" value="test" required>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 text-right">
            Password:&nbsp;
          </div>
          <div class="col-sm-6">
            <input type="password" name="pw" value="1234" required>
          </div>
        </div>
        <br>
        <div class="row text-center">
          <div class="col-sm-12">
            <input type="submit" value="Verbinden">
            <input type='hidden' value='1' name='dataVerbindung' />
          </div>
        </div>

    </div>
</form>
-->
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <div class='container'style='margin-top: 25px'>
     <div class='row text-center'>
       <div class='col-sm-12'>
         <h2>Schritt 1: Flug auswählen</h2>
         <hr>
       </div>
     </div>
       <div class='row'>
         <div class='col-sm-6 text-right'>Bitte geben Sie eine Flugnummer ein: &nbsp;</div>
         <div class='col-sm-6'><input type='number' name='flugnr'></div>
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

/*
$conn = null;

if( isset($_POST['dataVerbindung'])){
$servername = "localhost";
$username = $_POST['user'];
$password = $_POST['pw'];
$db = $_POST['db'];
$srv = $_POST['srv']; //Bsp Localhost
global $conn;
try {
   $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
catch(PDOException $e)
   {
   echo "Connection failed: " . $e->getMessage();
   }
}
*/
if(isset($_POST['flug'])){
  global $conn;
   $flightnr = $_POST['flugnr'];
   $sql = "SELECT * FROM flights WHERE flightnr = $flightnr";
   foreach($conn->query($sql) as $row) {
     echo "<div class='row'><div class='col-sm-2'>Airline</div><div class='col-sm-2'>Abflugszeit</div><div class='col-sm-2'>Abflugsflughafen</div><div class='col-sm-2'>Ankunftszeit</div><div class='col-sm-2'>Ankunftsflughafen</div><div class='col-sm-2'>Flugzeugart</div></div><br>";
     echo "<div class='row'><div class='col-sm-2' style='border-right:1px solid black'>". $row['airline'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['departure_time'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['departure_airport'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['destination_time'] ."</div><div class='col-sm-2' style='border-right:1px solid black'>". $row['destination_airport'] ."</div><div class='col-sm-2'>". $row['planetype'] ."</div></div>";
   }
   echo "</div>";
}
   //$conn = null;


?>
    </div>
  </body>
</html>
