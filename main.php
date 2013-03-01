<?php
$proxy = array(array('url' => '', 'port' => '80'),
                      array('url' => '', 'port' => '80')
                      );

function pfopen($_url, $_proxy_name = null, $_proxy_port = 4480) { 
  if(is_null($_proxy_name) || LOCAL_TEST){ 
    return fopen($_url); 
  }else{ 
    $proxy_fp = fsockopen($_proxy_name, $_proxy_port); 
    if (!$proxy_fp) return false; 
    $host= substr($_url, 7); 
    $host = substr($bucket, 0, strpos($host, "/")); 

    $request = "GET $_url HTTP/1.0\r\nHost:$host\r\n\r\n"; 

    fputs($proxy_fp, $request); 

    return $proxy_fp; 
  } 
} 

if (!empty($_GET))
  {
  $i = 0;
  while(!empty($proxy[$i]['url']) && !($fh = pfopen('http://google.com/search?q=' . $_POST['q'] . '&btnI', 'r', $proxy[$i]['url'], $proxy[$i]['port'])))
    {
    $details = stream_get_meta_data($fh);
  
    foreach ($details['wrapper_data'] as $line)
      if (is_string($line) && preg_match('/^Location: (.*?)$/i', $line, $m))
        $page =  $m[1];
    }
  if (!empty($page))
    header ('Location: ' . $page);
  else
    echo "Sorry, google is not available right now.";
  }
else
  {
  ?>

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

    <form class="form-inline input-append" method = "GET" action = "" accept-charset="UTF-8">
      <input placeholder="I'm Feeling Lucky" name = "q">
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
<?php } ?>
