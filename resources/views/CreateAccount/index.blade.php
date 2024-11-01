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

        #dancing-gif {
            width: 200px; /* Adjust the width as needed */
            height: auto;
            margin: 20px; /* Adjust the margin as needed */
            cursor: pointer;
        }
    </style>
</head>
<body>

    <nav class="nav-bar">
        <a href="/admin">Home</a>
        <a href="/users">Users</a>
        
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

    <!-- Dancing GIF -->
    <img id="dancing-gif" src="/dance.png" alt="Dancing GIF" onclick="playDancingGif()">
    
    <script>
        const xValues = ["Users", "Roles"];
        const yValues = [{{ $totalUsers }}];
        const barColors = ["green"];

        const dancingGif = document.getElementById('dancing-gif');

        function playDancingGif() {
            dancingGif.src = "/dancing.gif";
            let audio = new Audio("/wikii.mp3");
                        audio.play()
        }

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
</body>
</html>