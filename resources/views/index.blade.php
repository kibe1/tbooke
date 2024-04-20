<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tbooke</title>
<link href="css/custom.css" rel="stylesheet" type="text/css" >
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
  <div class="buttons">
    <a  href="{{route('login')}}" class="btn">Login</a>
    <a href="{{route('register')}}" class="btn">Register</a>
    {{-- <a class="btn">Explore Without Account</a> --}}
  </div>
  <div class="content">
    <h1>Welcome to Tbooke</h1>
    <p class="home-p" >Tbooke.net is more than just a platform,it’s a community where education professionals, institutions and learners share, connect and grow together all while enjoying content that’s educational and entertaining</p>
    <a href="/about" class="btn">Learn More</a>
  </div>
</div>

</body>
</html>