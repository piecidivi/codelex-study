<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Router task page</title>
    <link rel="shortcut icon" href="../../public/favicon.ico">
  </head>
  <body>
    <h1><?php echo $message; ?></h1>
    <form action="" method="POST">
      <label for="word">Please enter a word (ASCII letters)</label><br>
      <input type="text" id="word" name="word" pattern="[a-zA-Z]+" required>
      <input type="submit" name="submit" value="CLICK">
    </form>
    <h2>Or maybe You want to test get?</h2>
    <form action="/testView" method="GET">
      <input type="submit" value="GET THERE">
    </form>
  </body>
</html>