 <?php
  ob_start();

  header('Set-Cookie: manual_cookie=test123; Path=/; HttpOnly');
  setcookie('test_ob', 'value456', time() + 3600, '/');

  $headers = headers_list();
  ob_end_flush();

  echo "Headers after ob:<br><pre>";
  print_r($headers);
  echo "</pre>";

  echo "<br>headers_sent: " . (headers_sent($file, $line) ? "YES at $file:$line" : "NO");