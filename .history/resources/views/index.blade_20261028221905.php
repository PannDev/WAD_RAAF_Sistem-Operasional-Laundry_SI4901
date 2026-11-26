<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAW Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://kit.fontawesome.com/807d51979a.js" crossorigin="anonymous"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body>
    <main>
        <div class="judul-tabel">
            <div>
                <h1>Data Pelanggan</h1>
            </div>
            <button class="tombol-tambah btn btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#modalTambah">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Pelanggan</span>
            </button>

            <!-- Modal Tambah Pelanggan -->
            <div class="modal fade" id="modalTambah" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pelanggan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('pelanggan.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Khusus</label>
                                    <input type="text" name="catatan_khusus" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tabel--wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Catatan Khusus</th>
                        <th class="kolom-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $row)
                    <tr>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->no_telp }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>{{ $row->catatan_khusus }}</td>
                        <td class="aksi">
                            <!-- Tombol Edit Modal -->
                            <button class="tombol-ikon tombol-edit" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ $row->id }}">
                                <i class="fa-solid fa-pencil"></i>
                            </button>

                            <!-- Modal Edit Pelanggan -->
                            <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Pelanggan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('pelanggan.update', $row->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label text-start">Nama</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $row->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" name="no_telp" class="form-control"
                                                        value="{{ $row->no_telp }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control"
                                                        value="{{ $row->alamat }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Catatan Khusus</label>
                                                    <input type="text" name="catatan_khusus" class="form-control"
                                                        value="{{ $row->catatan_khusus }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('pelanggan.destroy', $row->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Lu yakin mau apus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="tombol-ikon tombol-hapus border-0">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>