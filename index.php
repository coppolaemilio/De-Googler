<?php
$proxiename = 'proxies';
if (!empty($_GET))
  $googleurl = 'http://google.com/search?q=' . $_GET['q'] . '&btnI';

foreach (array('pfopen', 'retrieve') as $ToRequire)
  if (file_exists(dirname(__FILE__) . '/' . $ToRequire . '.php'))
    require dirname(__FILE__) . '/' . $ToRequire . '.php';

// When the user tries to access a page.
if (!empty($_GET))
  {
  // Attempt to open normally the page
  if ($fh = fopen($googleurl, 'r'))
    $page = retrieve ($fh);
  
  // You don't like it? Take the proxies then, google!
  if (empty($page))
    {
    // Retrieve all the proxies in the array $proxy
    if ($fp = fopen (dirname(__FILE__) . '/' . $proxiename, 'r'))
      // While there are proxies
      while ($line = fgets ($fp))
        {
        // Separates each line in it's proxy and port for that proxy and saves it in an arrayva
       $p = explode(' ', $line);
        
        // We need this auxiliar array or $proxy won't be an array of arrays.
        $aux['url'] = $p[0];
        if (!empty($p[1]))
          $aux['port'] = $p[1];
        // Each element of proxy is an array, the first one being 'url' and the second one being 'port'
        $proxy[] = $inter;
        }
    
    // Attempt to open google as long as there are proxies available
    foreach ($proxy as $aproxy)
      {
      if ($fh = pfopen('http://google.com/search?q=' . $_GET['q'] . '&btnI',
                         $proxy[$i]['url'],
                         $proxy[$i]['port']))
      
      }
    
    while(!empty($proxy[$i]['url']) &&
          !())
      {
      // This is a bit repeat-yourself-ish...
      $details = stream_get_meta_data($fh);
      
      foreach ($details['wrapper_data'] as $line)
        if (is_string($line) && preg_match('/^Location: (.*?)$/i', $line, $m))
          $page = retrieve ()
      }
    }
  // Yay! It works! Go there then!
  if (!empty($page))
    header ('Location: ' . $page);
  }
// The main page
include dirname(__FILE__) . '/main.php';
