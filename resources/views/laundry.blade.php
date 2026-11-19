<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Harga - Laundry Asrama</title>
    <style>
        body { 
            font-family: "Poppins", sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #ffffff; 
            color: #000000; 
        }
        h2, h3 {
            font-family: "Montserrat", sans-serif;
        }
        .navbar { 
            background-color: #222222; 
            color: #ffffff; 
            padding: 15px 30px; 
            display: flex; 
            align-items: center; 
            gap: 30px; 
        }
        .navbar .brand { 
            font-family: "Montserrat", sans-serif;
            font-weight: bold; 
            font-size: 18px; 
        }
        .navbar a { 
            color: #ffffff; 
            text-decoration: none; 
            font-size: 14px; 
        }
        .content { 
            padding: 30px 40px; 
        }
        .section-box { 
            border: 1px solid #e2e8f0; 
            border-radius: 4px; 
            padding: 20px; 
            margin-bottom: 30px; 
            background: #ffffff; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        th, td { 
            padding: 12px 15px; 
            text-align: left; 
            border-bottom: 1px solid #e2e8f0; 
            font-size: 14px; 
        }
        th { 
            background-color: #f8fafc; 
            font-weight: bold; 
        }
        h3 { 
            margin-top: 0; 
            color: #1e293b; 
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="navbar">
        <div class="brand">LAUNDRY ASRAMA</div>
        <a href="/portal" style="font-weight: bold; text-decoration: underline;">Katalog Harga</a>
        <a href="/portal/pengaturan">Pengaturan</a>
    </div>

    <div class="content">
        <div style="margin-bottom: 25px;">
            <h2 style="margin: 0; font-size: 22px;">Daftar Harga Layanan</h2>
            <p style="margin: 5px 0 0 0; color: #64748b; font-size: 14px;">Silakan cek tarif reguler dan express layanan laundry kami.</p>
        </div>

        <!-- Tabel Paket Kiloan -->
        <div class="section-box">
            <h3>Paket Kiloan</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Layanan</th>
                        <th>Layanan</th>
                        <th>Tarif Reguler</th>
                        <th>Tarif Express (1 Hari)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semuaKiloan as $item)
                    <tr>
                        <td>{{ $item->id_layanan }}</td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td>Rp {{ number_format($item->harga_reguler, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->harga_express, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Paket Satuan -->
        <div class="section-box">
            <h3>Paket Satuan</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Layanan</th>
                        <th>Layanan</th>
                        <th>Tarif Reguler</th>
                        <th>Tarif Express (1 Hari)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semuaSatuan as $item)
                    <tr>
                        <td>{{ $item->id_layanan }}</td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td>Rp {{ number_format($item->harga_reguler, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->harga_express, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>