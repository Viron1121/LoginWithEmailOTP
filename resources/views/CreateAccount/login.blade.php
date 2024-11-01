<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('Designs/login.css')}}">
</head>
<body>

    <div class="parent clearfix">
        <div class="bg-illustration">
          
    
          <div class="burger-btn">
            <span></span>
            <span></span>
            <span></span>
          </div>
    
        </div>
        
        <div class="login">
        
          <div class="container">
            <h1>Login to access to<br />your account</h1>
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <div class="login-form">
              <form action="{{route('loginpost')}}"  method="post">
                @csrf
                @method('post')
                <input type="email" name="email" placeholder="E-mail Address">
                <input type="password" id="myInput" name="password" placeholder="Password">
    
                <div class="remember-form">
                    <input type="checkbox" onclick="myFunction()">
                  <span>Show Password</span>
                </div>
                <div class="forget-pass">
                  <a href="#">Forgot Password ?</a>
                </div>
    
                <button type="submit">LOG-IN</button>
                <a href="register"> No account yet? register here </a>
                
               
                  
             
                @if($errors->has('login_error'))
                <div class="alert alert-danger">
                    <script>
                        let audio = new Audio("mali.mp3");
                        audio.play()
                    </script>
                    {{ $errors->first('login_error') }}
                </div>
            @endif
    
              </form>
            </div>
        
          </div>
          </div>
      </div>
   
 
    
  

        <script>
        // show password
        
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
        </script>

    <script>           
       let audio = document.getElementById("audio");
        function qwe(){
            let audio = new Audio("email.mp3");
            audio.play();
        }
        play.addEventListener("click", qwe)
                                              
    </script>

</body>
</html>