<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<title>Sign In | Tbooke</title>
  <link href="css/custom.css" rel="stylesheet" type="text/css" >
	<link href="static/css/app.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100 main-login">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
      <div class="col-sm-8 col-md-6 mx-auto d-table welcome-tbooke">
          <div class="d-table-cell align-middle">
              <h1>Welcome to Tbooke</h1>
              <p class="home-p" >Tbooke.net is more than just a platform,it’s a community where education professionals, institutions and learners share, connect and grow together all while enjoying content that’s educational and entertaining</p>
              <a href="/about" class="btn">Learn More</a>
          </div>
      </div>
				<div class="col-sm-8 col-md-6 col-lg-6 col-xl-5 mx-auto d-table welcome-tbooke-2">
					<div class="d-table-cell align-middle">
						<div class="text-center mt-4">
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="POST" action="{{route('login')}}">
									 @csrf
									 @method('post')

										     @error('email')
												<div class="text-danger">{{ $message }}</div>
											 @enderror
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
										</div>
										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
												<label class="form-check-label text-small" for="customControlInline">Remember me</label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<input type="submit" class="btn btn-lg btn-primary" value="Submit">
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Don't have an account? <a href="{{route('register')}}">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="static/js/app.js"></script>

</body>

</html>