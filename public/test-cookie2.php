 <?php

  // Simple cookie without secure flag
  setcookie('test_simple', 'value123', time() + 3600, '/');

  // Check PHP settings
  echo "session.cookie_secure: " . ini_get('session.cookie_secure') . "<br>";
  echo "session.cookie_httponly: " . ini_get('session.cookie_httponly') . "<br>";
  echo "session.cookie_samesite: " . ini_get('session.cookie_samesite') . "<br>";
  echo "session.save_path: " . ini_get('session.save_path') . "<br>";

  echo "<br>Headers being sent:<br>";
  echo "<pre>";
  print_r(headers_list());
  echo "</pre>";