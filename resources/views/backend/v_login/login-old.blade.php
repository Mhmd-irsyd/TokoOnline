<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <style>
        /* Gaya umum untuk body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Gaya untuk judul */
        h3 {
            text-align: center;
            font-size: 26px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Gaya untuk form */
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        /* Gaya untuk label */
        label {
            font-size: 16px;
            color: #34495e;
        }

        /* Gaya untuk input */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        /* Gaya tombol submit */
        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        /* Gaya untuk pesan error */
        .alert-danger {
            color: #e74c3c;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        /* Gaya untuk feedback error */
        .invalid-feedback {
            color: #e74c3c;
            font-size: 14px;
        }

        /* Gaya untuk tombol close */
        .close {
            float: right;
            font-size: 18px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div>
        <h3>{{ $judul }}</h3>

        <!-- Menampilkan Pesan Error -->
        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ session('error') }}</strong>
        </div>
        @endif
        <!-- Akhir Pesan Error -->

        <!-- Form Login -->
        <form action="{{ route('backend.login') }}" method="post">
            @csrf
            <div>
                <label for="email">User</label><br>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                @error('email')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" value="{{ old('password') }}"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                @error('password')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <button type="submit">Login</button>
        </form>
        <!-- Akhir Form Login -->
    </div>
</body>
</html>

