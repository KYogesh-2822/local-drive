<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email domain
    $domain = explode('@', $email)[1];
    if ($domain !== 'imarkinfotech.com') {
        echo 'Please use an email address with the imarkinfotech.com domain.';
        exit;
    }

    // cURL to call the API and generate token
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://audit.imarkinfotech.com/api/v1/account/generate-token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query(array('email' => $email, 'password' => $password)),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));

    $response = curl_exec($curl);

    if ($curl_errno = curl_errno($curl)) {
        $curl_error = curl_error($curl);
        curl_close($curl);
        echo "cURL error ({$curl_errno}): {$curl_error}";
        exit;
    }

    curl_close($curl);

    $response_data = json_decode($response, true);
    if (isset($response_data['token'])) {
        $_SESSION['authToken'] = $response_data['token'];
        header('Location: /project-listing.php');
        exit;
    } else {
        echo 'Error generating token';
        exit;
    }
}
?>
