@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Pelanggan</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal">
            Tambah Pelanggan
        </button>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Catatan Khusus</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $index => $pelanggan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pelanggan->nama }}</td>
                        <td>{{ $pelanggan->no_telp }}</td>
                        <td>{{ $pelanggan->alamat ?? '-' }}</td>
                        <td>{{ $pelanggan->catatan_khusus ?? '-' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editPelangganModal-{{ $pelanggan->id }}">
                                Edit
                            </button>

                            <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus data pelanggan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('pelanggan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPelangganModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Catatan Khusus</label>
                    <textarea name="catatan_khusus" class="form-control" rows="3">{{ old('catatan_khusus') }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($pelanggans as $pelanggan)
<div class="modal fade" id="editPelangganModal-{{ $pelanggan->id }}" tabindex="-1"
    aria-labelledby="editPelangganModalLabel-{{ $pelanggan->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editPelangganModalLabel-{{ $pelanggan->id }}">Edit Data Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pelanggan->nama) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control"
                        value="{{ old('no_telp', $pelanggan->no_telp) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"
                        rows="2">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Catatan Khusus</label>
                    <textarea name="catatan_khusus" class="form-control"
                        rows="3">{{ old('catatan_khusus', $pelanggan->catatan_khusus) }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection