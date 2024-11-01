<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('Designs/otp.css' )}}">
    <title>Document</title>
</head>
<body>

        <form action="{{route('verifysendotp')}}" method="post">
            @csrf
            @method('post')
 <div>
    <div>
        <p>Enter your 4 digits verification code</p>
         <input type="password" name="otp" id="">
         <input type="submit" name="verify" value="Verify" id="">
    </div>
 </div>
   
</form>
  

</body>
</html>