<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Web Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Background image styling */
        body {
            background-image: url('images/lapangan.jpg'); /* Replace 'your-image.jpg' with your actual image file name */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Login card styling */
        .card {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            margin-top: 10vh; /* Adjusted margin to move the card up */
        }

        .card-body {
            padding: 2rem;
        }

        /* Centered and styled header */
        .card h3 {
            font-weight: 600;
            color: #333;
        }

        /* Custom button styling */
        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="w-50 d-block mx-auto">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login</h3>
                    @if(session('error'))
                    <div class="alert alert-danger fade show" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="/login" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                            <small class="text-muted">* Password harus memiliki minimal 6 karakter</small>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
