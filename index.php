<?php
// Variables
$proxiefile = 'proxies';
if (!empty($_GET))
  $googleurl = 'http://google.com/search?q=' . $_GET['q'] . '&btnI';

// Require all the used files. TODO: __autoload()
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
  if (empty($page) && $fp = fopen (dirname(__FILE__) . '/' . $proxiefile, 'r'))
    {
    // Each proxy is stored in a line
    while ($line = fgets ($fp))
      {
      // Separates each line in it's proxy and port for that proxy and saves it in an array
      $p = explode(' ', $line);
      
      // We need this auxiliar array or $proxy won't be an array of arrays.
      $aux['url'] = (!empty($p[0])) ? $p[0] : null;
      $aux['port'] = (!empty($p[1])) ? $p[1] : null;
      
      // Each element of $proxy is an array, the first one being 'url' and the second one being 'port'
      $proxy[] = $inter;
      }
    
    // Attempt to open google as long as there are proxies available
    foreach ($proxy as $aproxy)
      // If a valid url is retrieved in $page
      if ($fh = pfopen($googleurl, $aproxy['url'], $aproxy['port']) && $page = retrieve ($fh))
        // Get out of the foreach loop
        break;
    }
  
  // Yay! It works! Go there then!
  if (!empty($page))
    header ('Location: ' . $page);
  }

// The main page
include dirname(__FILE__) . '/main.php';
