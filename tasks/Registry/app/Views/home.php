<?php

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registry</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico">
  </head>
  <body>
    <section>
      <form action="/add" method="post">
        <label for="firstName">First name:</label><br>
        <input type="text" id="firstName" name="firstName" value="Tes"><br>
        <label for="lastName">Last name:</label><br>
        <input type="text" id="lastName" name="lastName" value="Yes"><br><br>
        <input type="submit" value="Add">
      </form>
    </section>

  </body>
</html>
