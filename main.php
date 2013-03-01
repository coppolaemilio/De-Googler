<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>De-Googler</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://dl.dropbox.com/u/31195548/html/bootstrap/css/bootstrap.css" media="all" type="text/css" rel="stylesheet">

  <link rel="stylesheet" href="https://dl.dropbox.com/u/31195548/html/bootstrap/css/style.css">
</head>
<body>

<div class="container" style = "color: black;">
  <header>
    De-Googler
  </header>

  <div role="main">
    
    <?php if ($not_found == TRUE) echo "Couldn't retrieve the page you were looking for. Please try again."; ?>
    
    <form class="form-inline input-append" method = "GET" action = "" accept-charset="UTF-8">
      <input name = "q" value = "<?php if ($_GET['q']) echo $_GET['q']; ?>" placeholder="I'm Feeling Lucky">
      <input type = "submit" value = "Search">
    </form>
  </div>

  <footer>
    <p class="small">With De-Googler, you get the first result of <span class="white">google</span> search,<br/>but you don't get <span class="white">tracked</span> or registered on their servers.</p>
  <p class="small"><a href="mailto:coppolaemilio@gmail.com?subject=De-Googler">contact me</a></p>
  </footer>
</div>

</body>
</html>
