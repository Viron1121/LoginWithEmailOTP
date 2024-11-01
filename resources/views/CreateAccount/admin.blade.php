<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="{{url('Designs/admin.css') }}">
    <title>Document</title>

    <style>
        #chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <nav class="nav-bar">
        <a href="/admin">Home</a>
        <a href="/users">Users</a>
        <a href="" data-toggle="modal" data-target="#myModal">Roles</a>
        <div class="dropdown">
            <span>My Account</span>
            <div class="dropdown-content">
              
                <a href="/logout">Logout</a>
            </div>
        </div>
    </nav>
 

    @error('roleName')
   <p>{{ $message }}</p>
  @enderror

    <!-- Chart Container -->
    <div id="chart-container">
        <!-- chart-->
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    </div>

    <script>
        const xValues = ["Users", "Roles"];
        const yValues = [{{ $totalUsers }}, {{ $totalRoles }}];
        const barColors = ["green", "blue"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: "Numbers of users"
                }
            }
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add UserType</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('addrole') }}" >
                        @csrf
                        @method('post')
                        <select name="" id="">
                            @foreach($Roles as $Role)
                            <option value="{{$Role->roleName}}">{{$Role->roleName}}</option>
                            @endforeach
                        </select>
                        <div>
                            <label for="">UserType</label>
                            <input type="text" required name="rolename" placeholder="Add Here...">
                            <input type="submit" name="" value="add">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>