<?php
include dirname(__FILE__) . '/pfopen.php';

if (!empty($_GET))
  {
  $i = 0;
  while(!empty($proxy[$i]['url']) &&
        !($fh = pfopen('http://google.com/search?q=' . $_POST['q'] . '&btnI',
                       $proxy[$i]['url'],
                       $proxy[$i]['port'])))
    {
    $details = stream_get_meta_data($fh);
  
    foreach ($details['wrapper_data'] as $line)
      if (is_string($line) && preg_match('/^Location: (.*?)$/i', $line, $m))
        $page =  $m[1];
    }
  if (!empty($page))
    header ('Location: ' . $page);
  else
    include dirname(__FILE__) . '/empty.php';
  }
else
  include dirname(__FILE__) . '/main.php';
