<?php

// Retrieve the last url from the meta data
function retrieve ($file)
  {
  $details = stream_get_meta_data($file);
      
  foreach ($details['wrapper_data'] as $line)
    if (is_string($line) && preg_match('/^Location: (.*?)$/i', $line, $m))
      $page = $m[1];
      
  if (strpos($page, 'google') === FALSE)
    return $page;
  }
