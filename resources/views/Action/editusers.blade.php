<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>



    <div class="container mt-5">
        <h1 class="mb-4">Edit This User</h1>

        <form method="post" action="{{ route('update', ['updateusers' => $Users]) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" required name="lastname" value="{{ $Users->lastName }}" placeholder="Lastname">
            </div>

            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" required name="firstname" value="{{ $Users->firstName }}" placeholder="Firstname">
            </div>

            <div class="form-group">
                <label for="middlename">Middlename</label>
                <input type="text" class="form-control" name="middlename" value="{{ $Users->middleName }}" placeholder="Middlename">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" required name="email" value="{{ $Users->email }}" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" required name="password" value="{{ $Users->password }}" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="usertype">Usertype</label>
                <select class="form-control" name="usertype">
                    @foreach($Roles as $Role)
                    <option value="{{ $Role->roleName }}">{{ $Role->roleName }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
           <a href="/users" class="btn btn-dark"> Back </a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script>
        localStorage.openpages = Date.now();
        window.addEventListener('storage', function (e){

            if(e.key == "openpages" ){
                localStorage.page_available = Date.now();
             var id = 26;
            }
            if(e.key == "page_available" && id == '26'){
                alert("One more page already open");
                window.location.href = "/users";
            }
        }, false)
    </script>



</body>
</html>
