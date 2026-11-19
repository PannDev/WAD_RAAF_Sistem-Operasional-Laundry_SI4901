<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Layanan - Laundry Asrama</title>
    <style>
        body { 
            font-family: "Poppins", sans-serif;
            sans-serif; margin: 0; 
            padding: 0; 
            background-color: #f8fafc; 
            color: #000000; 
        }
        .container { 
            max-width: 500px; 
            margin: 50px auto; 
            background: #ffffff; 
            padding: 30px; 
            border-radius: 6px; 
            border: 1px solid #e2e8f0; 
        }
        h2 { 
            font-family: "Montserrat", sans-serif;
            margin-top: 0; 
            color: #1e293b; 
            font-size: 20px; 
            margin-bottom: 20px; 
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: bold; 
            font-size: 14px; 
            color: #334155; 
        }
        input, select { 
            width: 100%; 
            padding: 10px; 
            border: 1px solid #cbd5e1; 
            border-radius: 4px; 
            font-size: 14px; 
            box-sizing: border-box; 
        }
        input:disabled { 
            background-color: #f1f5f9; 
            color: #64748b; 
        }
        .btn-update { 
            background-color: #0284c7; 
            color: white; padding: 12px 20px; 
            border: none; 
            border-radius: 4px; 
            font-size: 14px; 
            font-weight: bold; 
            cursor: pointer; 
            width: 100%; 
        }
        .btn-update:hover { 
            background-color: #0369a1; 
        }
        .btn-kembali { 
            display: block; 
            text-align: center; 
            margin-top: 15px; 
            color: #64748b; 
            text-decoration: none; font-size: 14px; 
        }
        .btn-kembali:hover { 
            text-decoration: underline; 
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Edit Layanan Laundry</h2>
        
        <form action="/portal/update/{{ $item->id_layanan }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>ID Layanan</label>
                <input type="text" value="{{ $item->id_layanan }}" disabled>
            </div>

            <div class="form-group">
                <label>Kategori Paket</label>
                <input type="text" value="{{ $item->kategori }}" disabled>
            </div>

            <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" name="nama" value="{{ $item->nama_layanan }}" required>
            </div>

            <div class="form-group">
                <label>Tarif Reguler (Rp)</label>
                <input type="number" name="reguler" value="{{ $item->harga_reguler }}" required>
            </div>

            <div class="form-group">
                <label>Tarif Express / 1 Hari (Rp)</label>
                <input type="number" name="express" value="{{ $item->harga_express }}" required>
            </div>

            <button type="submit" class="btn-update">Perbarui Layanan</button>
        </form>

        <a href="/portal/pengaturan" class="btn-kembali">← Kembali ke Pengaturan</a>
    </div>

</body>
</html>