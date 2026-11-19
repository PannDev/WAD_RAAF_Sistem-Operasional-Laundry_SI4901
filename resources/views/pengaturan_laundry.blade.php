<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Layanan - Laundry Asrama</title>
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
        .btn-tambah { 
            background-color: #0284c7; 
            color: white; 
            padding: 10px 15px; 
            border-radius: 4px; 
            text-decoration: none; 
            font-size: 14px; 
            font-weight: bold; 
        }
        .btn-edit { 
            color: #0284c7; 
            text-decoration: none; 
            font-weight: bold; 
            margin-right: 10px; 
        }
        .btn-edit:hover { 
            text-decoration: underline; 
        }
        .btn-hapus { 
            color: #ef4444; 
            text-decoration: none; 
            font-weight: bold; 
        }
        .btn-hapus:hover { 
            text-decoration: underline; 
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <div class="navbar">
        <div class="brand">LAUNDRY ASRAMA</div>
        <a href="/portal">Katalog Harga</a>
        <a href="/portal/pengaturan" style="font-weight: bold; text-decoration: underline;">Pengaturan</a>
    </div>

    <div class="content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <div>
                <h2 style="margin: 0; font-size: 22px;">Pengaturan & Kelola Layanan</h2>
                <p style="margin: 5px 0 0 0; color: #64748b; font-size: 14px;">Panel Admin untuk menambah, mengubah, atau menghapus daftar harga.</p>
            </div>
            <a href="/portal/tambah" class="btn-tambah">+ Tambah Layanan</a>
        </div>

        <!-- Tabel Paket Kiloan -->
        <div class="section-box">
            <h3>Kelola Paket Kiloan</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Layanan</th>
                        <th>Layanan</th>
                        <th>Tarif Reguler</th>
                        <th>Tarif Express (1 Hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semuaKiloan as $item)
                    <tr>
                        <td>{{ $item->id_layanan }}</td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td>Rp {{ number_format($item->harga_reguler, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->harga_express, 0, ',', '.') }}</td>
                        <td>
                            <a href="/portal/edit/{{ $item->id_layanan }}" class="btn-edit">Edit</a>
                            <a href="/portal/hapus/{{ $item->id_layanan }}" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Paket Satuan -->
        <div class="section-box">
            <h3>Kelola Paket Satuan</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Layanan</th>
                        <th>Layanan</th>
                        <th>Tarif Reguler</th>
                        <th>Tarif Express (1 Hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semuaSatuan as $item)
                    <tr>
                        <td>{{ $item->id_layanan }}</td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td>Rp {{ number_format($item->harga_reguler, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->harga_express, 0, ',', '.') }}</td>
                        <td>
                            <a href="/portal/edit/{{ $item->id_layanan }}" class="btn-edit">Edit</a>
                            <a href="/portal/hapus/{{ $item->id_layanan }}" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>