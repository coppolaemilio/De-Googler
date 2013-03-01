<?php
include dirname(__FILE__) . '/pfopen.php';
$proxiename = 'proxies';
// When the user tries to access a page.
if (!empty($_GET))
  {
  // Attempt to open normally the page
  if ($fh = fopen('http://google.com/search?q=' . $_GET['q'] . '&btnI', 'r'))
    {
    $details = stream_get_meta_data($fh);
    $page = $details['uri'];
    }
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
    
    $i = 0;
    // Attempt to open google as long as there are proxies available
    while(!empty($proxy[$i]['url']) &&
          !($fh = pfopen('http://google.com/search?q=' . $_GET['q'] . '&btnI',
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
  if (!empty($page) && strpos($page, 'google') === FALSE)
    header ('Location: ' . $page);
  
  // When there's no url after trying to get it 'so hard' or the url is google
  else
    $not_found = TRUE;
  }
// The main page
include dirname(__FILE__) . '/main.php';
