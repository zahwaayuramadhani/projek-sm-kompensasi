<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Kompensasi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #e9edf2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #ffffff;
            padding: 40px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        /* Container untuk logo gambar */
        .logo-container {
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
        }

        .logo-img {
            width: 80px; /* Ukuran bisa kamu sesuaikan */
            height: auto;
            object-fit: contain;
        }

        .title {
            font-size: 16px;
            margin-bottom: 25px;
            color: #333;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 20px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            box-sizing: border-box; /* Agar padding tidak merusak lebar */
        }

        input:focus {
            border-color: #63A0EF;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 20px;
            /* Menggunakan palet biru yang sama dengan sidebar */
            background: linear-gradient(to right, #63A0EF, #4a90e2); 
            color: white;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: bold;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .footer {
            margin-top: 15px;
            font-size: 12px;
            color: #777;
        }

        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <!-- Logo JKB menggantikan teks JB -->
        <div class="logo-container">
            <img src="{{ asset('img/jkb.png') }}" alt="Logo JKB" class="logo-img">
        </div>
        
        <div class="title">Sistem Manajemen Kompensasi</div>

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn">Masuk</button>
        </form>

        <div class="footer">
            Belum Punya Akun? <a href="{{ route('register') }}">Daftar Disini</a>
        </div>
    </div>
</body>
</html>