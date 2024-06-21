<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-commerce</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ URL::asset('assets/img/test.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Changed from 120vh */
            margin: 0;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.5);
            padding: 84px;
            border-radius: 42px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 379px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
        }
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"],
        .register-container input[type="tel"],
        .register-container input[type="date"],
        .register-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .register-container button {
            background-color: #4e0efd;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .register-container button:hover {
            background-color: #0051ff;
        }

        .register-container {
            /* تغيير العرض والارتفاع */
            width: 550px;
            padding: 64px; /* تغيير الهوامش الداخلية */
        }
        .register-container a {
            color: #4e0efd;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        @if (Session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session()->get('add') }}</strong>
        </div>
      @endif
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
            <div class="btn btn-danger">{{ $message }}</div>
            @enderror
            <input type="email" name="email" placeholder="Email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
            <div class="btn btn-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" value="{{ old('password') }}">
            @error('password')
            <div class="btn btn-danger">{{ $message }}</div>
            @enderror
            
            <input type="tel" name="phone" placeholder="Phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}">
            @error('phone')
            <div class="btn btn-danger">{{ $message }}</div>
            @enderror
            
            <input type="date" name="birthdate" placeholder="Birthdate" class="@error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}">
            @error('birthdate')
            <div class="btn btn-danger">{{ $message }}</div>
            @enderror
            
            <input type="text" name="address" placeholder="Address" class="@error('address') is-invalid @enderror" value="{{ old('address') }}">
            @error('address')
            <div class="btn btn-danger">{{ $message }}</div>
            @enderror
            
            <button type="submit">Register</button>
        </form>
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
</body>
</html>
