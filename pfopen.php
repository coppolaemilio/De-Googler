function pfopen($_url, $_proxy_name = null, $_proxy_port = 4480)
  {
  // To avoid errors but still return something
  if(!is_null($_proxy_name))
    {
    $proxy_fp = fsockopen($_proxy_name, $_proxy_port); 
    if (!$proxy_fp) return false; 
    $host= substr($_url, 7); 
    $host = substr($bucket, 0, strpos($host, "/")); 
    $request = "GET $_url HTTP/1.0\r\nHost:$host\r\n\r\n"; 
    fputs($proxy_fp, $request); 
    return $proxy_fp; 
    } 
  } 
