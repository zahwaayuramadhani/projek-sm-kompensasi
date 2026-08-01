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
            min-height: 100vh; 
            margin: 0;
            padding: 40px 0; 
            box-sizing: border-box;
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
            width: 80px; 
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

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 13px;
            outline: none;
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
            color: #333;
        }

        input:focus, select:focus {
            border-color: #63A0EF;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 20px;
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
    <div class="logo-container">
        <img src="{{ asset('img/jkb.png') }}" alt="Logo JKB" class="logo-img">
    </div>

    <div class="title">Daftar Akun Baru</div>
    <div class="subtitle">Sistem Manajemen Kompensasi JKB</div>

    <form action="{{ route('register') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div style="color: red; font-size: 11px; margin-bottom: 15px; text-align: left; background: #ffe6e6; padding: 10px; border-radius: 6px;">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="form-group">
        <label>NPM (AKAN MENJADI USERNAME)</label>
        <input type="text" name="npm" value="{{ old('npm') }}" placeholder="Masukkan NPM Anda" required>
    </div>

    <div class="form-group">
        <label>NAMA LENGKAP</label>
        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap Sesuai KTM" required>
    </div>

    <div class="form-group">
        <label>EMAIL</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Aktif" required>
    </div>

    <div class="form-group">
        <label>PROGRAM STUDI</label>
        <select name="id_prodi" required>
            <option value="">-- Pilih Program Studi --</option>
            @foreach ($prodi as $p)
                <option value="{{ $p->id_prodi }}" {{ old('id_prodi') == $p->id_prodi ? 'selected' : '' }}>
                    {{ $p->nama_prodi }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>KELAS</label>
        <select name="kelas" required>
            <option value="">-- Pilih Kelas --</option>
            <option value="1A" {{ old('kelas') == '1A' ? 'selected' : '' }}>1A</option>
            <option value="1B" {{ old('kelas') == '1B' ? 'selected' : '' }}>1B</option>
            <option value="1C" {{ old('kelas') == '1C' ? 'selected' : '' }}>1C</option>
            <option value="1D" {{ old('kelas') == '1D' ? 'selected' : '' }}>1D</option>
            <option value="2A" {{ old('kelas') == '2A' ? 'selected' : '' }}>2A</option>
            <option value="2B" {{ old('kelas') == '2B' ? 'selected' : '' }}>2B</option>
            <option value="2C" {{ old('kelas') == '2C' ? 'selected' : '' }}>2C</option>
            <option value="2D" {{ old('kelas') == '2D' ? 'selected' : '' }}>2D</option>
            <option value="3A" {{ old('kelas') == '3A' ? 'selected' : '' }}>3A</option>
            <option value="3B" {{ old('kelas') == '3B' ? 'selected' : '' }}>3B</option>
            <option value="3C" {{ old('kelas') == '3C' ? 'selected' : '' }}>3C</option>
            <option value="3D" {{ old('kelas') == '3D' ? 'selected' : '' }}>3D</option>
            <option value="4A" {{ old('kelas') == '4A' ? 'selected' : '' }}>4A</option>
            <option value="4B" {{ old('kelas') == '4B' ? 'selected' : '' }}>4B</option>
            <option value="4C" {{ old('kelas') == '4C' ? 'selected' : '' }}>4C</option>
            <option value="4D" {{ old('kelas') == '4D' ? 'selected' : '' }}>4D</option>
        </select>
    </div>

    <div class="form-group">
        <label>PASSWORD</label>
        <input type="password" name="password" placeholder="Buat Password" required>
    </div>

    <div class="form-group">
        <label>KONFIRMASI PASSWORD</label>
        <input type="password" name="password_confirmation" placeholder="Ulangi Password" required>
    </div>

    <button type="submit" class="btn">Daftar Akun</button>
    </form>

    <div class="footer">
        Sudah Punya Akun? <a href="{{ route('login') }}">Masuk Disini</a>
    </div>
</div>

</body>
</html>