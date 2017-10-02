<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Datenerfassung</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
<form action="fluginfo.php" method="post">
    <div class='container'style='margin-top: 25px'>
     <div class='row text-center'>
       <div class='col-sm-12'>
         <h2>Verbindungsdaten</h2>
         <hr>
       </div>
     </div>
         <div class='row'>
          <div class="col-sm-6 text-right">
            Servername: &nbsp;
          </div>
          <div class="col-sm-6">
            <input type="text" name="servername" value="localhost" required />
          </div>
         </div>
         <div class='row'>
           <div class="col-sm-6 text-right">
             Datenbankname: &nbsp;
           </div>
           <div class="col-sm-6">
             <input type="text" name="db" value="flugdaten" required />
           </div>
         </div>
         <div class='row'>
           <div class="col-sm-6 text-right">
             Username: &nbsp;
           </div>
           <div class="col-sm-6">
             <input type="text" name="username" value="test" required />
           </div>
         </div>
         <div class='row'>
           <div class="col-sm-6 text-right">
             Passwort: &nbsp;
           </div>
           <div class="col-sm-6">
             <input type="password" name="password" value="1234" required />
           </div>
         </div>
         <br>
         <div class='row text-center'>
           <div class='col-sm-12 text-center'>
             <input type='submit' value='Verbinden'>
           </div>
         </div>
      </div>
</form>
  </body>
</html>
