<?php                                                                                                                 
  // Check HTTPS detection
  echo "HTTPS: " . (isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : 'NOT SET') . "<br>";
  echo "HTTP_X_FORWARDED_PROTO: " . (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO']
  : 'NOT SET') . "<br>";
  echo "REQUEST_SCHEME: " . (isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'NOT SET') . "<br>";

  // Try setting a cookie manually
  setcookie('test_cookie', 'hello123', [
      'expires' => time() + 3600,
      'path' => '/',
      'domain' => '',
      'secure' => true,
      'httponly' => true,
      'samesite' => 'Lax'
  ]);

  echo "<br>Cookie set attempted!<br>";
  echo "Check Response Headers for Set-Cookie";