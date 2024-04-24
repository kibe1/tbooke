<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up | Tbooke</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="static/css/app.css" rel="stylesheet">
</head>
<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form method="POST" action="{{ route('register') }}">
										<div class="text-center mt-4">
											<h1 class="h2">Get started with Tbooke</h1>
											<p class="lead">
												Join Tbooke for professional networking and constructive education-focused conversations.
											</p>
										</div>
                                        @csrf
                                        @method('post')
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select User Type</label>
                                            @error('profile_type')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <select name="profile_type" class="form-select mb-3 @error('profile_type') is-invalid @enderror">
                                                <option value="student" {{ old('profile_type') == 'student' ? 'selected' : '' }}>Student/Learner</option>
                                                <option value="teacher" {{ old('profile_type') == 'teacher' ? 'selected' : '' }}>Teacher/Tutor</option>
                                                {{-- <option value="institution" {{ old('profile_type') == 'institution' ? 'selected' : '' }}>Institution</option>
                                                <option value="other" {{ old('profile_type') == 'other' ? 'selected' : '' }}>Other</option> --}}
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Enter password" />
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <input type="submit" class="btn btn-lg btn-primary" value="Sign Up" />
                                        </div>
										<br>
										<div class="text-center mb-3">
											Already have an account? <a href="{{ route('login') }}">Log In</a>
										</div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="static/js/app.js"></script>
</body>
</html>
