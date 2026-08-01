    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body { font-family: 'Arial', sans-serif; font-size: 11px; }
            .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
            .header h2 { margin: 0; text-transform: uppercase; font-size: 16px; }
            
            table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            th, td { border: 1px solid #333; padding: 6px; text-align: left; }
            th { background-color: #f2f2f2; text-align: center; }
            
            .text-center { text-align: center; }
            .footer { margin-top: 30px; text-align: right; }
        </style>
    </head>
    <body>

        <div class="header">
            <h2>KOMPENSASI MAHASISWA</h2>
            <h2>JURUSAN KOMPUTER DAN BISNIS</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>NPM</th>
                    <th>PRODI</th>
                    <th>KELAS</th>
                    <th>MATA KULIAH</th>
                    <th>ALFA</th>
                    <th>KOMPENSASI</th>
                    <th>SATUAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->npm ?? '-' }}</td>   
                    <td>{{ $item->mahasiswa->prodi->kode_prodi ?? '-' }}</td>  
                    <td>{{ $item->mahasiswa->kelas ?? '-' }}</td>
                    <td>{{ $item->mata_kuliah }}</td>
                    <td class="text-center">{{ $item->jam_alfa ?? '0' }}</td>
                    <td class="text-center">{{ $item->jam_kompensasi ?? '0' }}</td>
                    <td>{{ $item->satuan ?? 'Jam' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
        </div>

    </body>
    </html>