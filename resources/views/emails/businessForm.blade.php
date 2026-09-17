<!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h1>New Enquire from business rentail.</h1>

  
    <p>Primary Contact Name : {{$mailData['name'] ?? ''}}</p>
    <p>Email address : {{$mailData['email'] ?? ''}}</p>
    <p>Phone number : {{$mailData['phone'] ?? ''}}</p>
    <p>Type of vehicle : {{$mailData['type'] ?? ''}}</p>
    <p>Dates : {{$mailData['date'] ?? ''}}</p>
     
    <h6>Thank you</h6>
</body>
</html>