<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Manajemen Kompensasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
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
            width: 380px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        /* Container Logo Gambar */
        .logo-container {
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
        }

        .logo-img {
            width: 80px; /* Ukuran disamakan dengan login */
            height: auto;
            object-fit: contain;
        }

        .title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: #333;
        }

        .subtitle {
            font-size: 12px;
            color: #777;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 11px;
            font-weight: 700;
            color: #555;
            display: block;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 13px;
            outline: none;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #63A0EF;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 20px;
            /* Pakai gradient biru yang konsisten */
            background: linear-gradient(to right, #63A0EF, #4a90e2);
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .footer a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 700;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <!-- Ganti logo teks JB dengan gambar JKB -->
    <div class="logo-container">
        <img src="{{ asset('img/jkb.png') }}" alt="Logo JKB" class="logo-img">
    </div>

    <div class="title">Daftar Akun Baru</div>
    <div class="subtitle">Sistem Manajemen Kompensasi JKB</div>

    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label>USERNAME</label>
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <label>PASSWORD</label>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label>KONFIRMASI PASSWORD</label>
            <input type="password" name="konfirmasi_password" placeholder="Konfirmasi Password" required>
        </div>

        <button type="submit" class="btn">Daftar</button>
    </form>

    <div class="footer">
        Sudah Punya Akun? <a href="{{ route('login') }}">Masuk Disini</a>
    </div>
</div>

</body>
</html>