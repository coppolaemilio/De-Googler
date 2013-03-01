<?php
include dirname(__FILE__) . '/pfopen.php';

// When the user tries to access a page.
if (!empty($_GET))
  {
  // Attempt to open normally the page
  if (fopen('http://google.com/search?q=' . $_POST['q'] . '&btnI', 'r'))
    {
    $details = stream_get_meta_data($fh);
    
    foreach ($details['wrapper_data'] as $line)
      if (is_string($line) && preg_match('/^Location: (.*?)$/i', $line, $m))
        $page =  $m[1];
    }
  
  // You don't like it? Take the proxies then, google!
  if (empty($page))
    {
    // Retrieve all the proxies in the array $proxy
    if ($fp = fopen (dirname(__FILE__) . '/proxies', 'r'))
      // While there are proxies
      while ($line = fgets ($fp))
        {
        // Separates each line in it's proxy and port for that proxy and saves it in an array
       $p = explode(' ', $line);
        
        // We need this auxiliar array or $proxy won't be an array of arrays.
        $aux['url'] = $p[0];
        if (!empty($p[1]))
          $aux['port'] = $p[1];

        // Each element of proxy is an array, the first one being 'url' and the second one being 'port'
        $proxy[] = $inter;
        }
    $i = 0;
    // Attempt to open google as long as there are proxies available
    while(!empty($proxy[$i]['url']) &&
          !($fh = pfopen('http://google.com/search?q=' . $_POST['q'] . '&btnI',
                         $proxy[$i]['url'],
                         $proxy[$i]['port'])))
      {
      // This is a bit repeat-yourself-ish...
      $details = stream_get_meta_data($fh);
      
      foreach ($details['wrapper_data'] as $line)
        if (is_string($line) && preg_match('/^Location: (.*?)$/i', $line, $m))
          $page =  $m[1];
      }
    }
  // Yay! It works! Go there then!
  if (!empty($page))
    header ('Location: ' . $page);
  
  // When there's no url after trying to get it 'so hard'
  else
    $not_found = TRUE;
  }
// The main page
else
  include dirname(__FILE__) . '/main.php';
