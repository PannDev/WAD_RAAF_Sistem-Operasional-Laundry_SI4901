@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000px;">

        {{-- Banner Header --}}
        <header class="p-4 mb-4 bg-primary text-white rounded-3 shadow-sm text-center">
            <h1 class="h3 fw-bold mb-1">Sistem Operasional Laundry</h1>
            <p class="mb-0 text-white-50">Modul Mesin &amp; Peralatan (Individu B)</p>
        </header>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="alert alert-dark alert-dismissible fade show border-dark" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Card Utama: Header + Tombol (+) & Tabel Daftar Mesin --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                    <h2 class="h5 text-primary mb-0">Daftar Inventaris Mesin</h2>

                    <button type="button" class="btn btn-primary fw-bold d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalMesin">
                        <span class="fs-5 lh-1">+</span>
                        <span>Tambah Mesin</span>
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Kode / Nama</th>
                                <th>Jenis</th>
                                <th>Merek</th>
                                <th>Kapasitas</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_mesin as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $row->kode }}</td>
                                    <td>{{ $row->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $row->merek }}</td>
                                    <td>{{ $row->kapasitas }} Kg</td>
                                    <td class="text-center">
                                        @if ($row->status == 'Ready')
                                            <span class="badge bg-dark">Ready</span>
                                        @elseif ($row->status == 'Sedang Digunakan')
                                            <span class="badge bg-secondary">Sedang Digunakan</span>
                                        @else
                                            <span class="badge border border-dark text-dark bg-white">Maintenance</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mesin.edit', $row->id) }}" class="btn btn-warning btn-sm fw-bold px-2 py-1">
                                            Edit
                                        </a>
                                        <form action="{{ route('mesin.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm fw-bold px-2 py-1">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">Belum ada data inventaris mesin.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Pop-up Modal: Form Tambah / Edit Mesin --}}
    <div class="modal fade" id="modalMesin" tabindex="-1" aria-labelledby="modalMesinLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-dark rounded-3">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title mb-0" id="modalMesinLabel">
                        {{ $edit_data ? 'Edit Data Mesin' : 'Tambah Mesin Baru' }}
                    </h5>

                    @if ($edit_data)
                        <a href="{{ route('mesin.index') }}" class="btn-close btn-close-white" aria-label="Close"></a>
                    @else
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    @endif
                </div>

                <form action="{{ $edit_data ? route('mesin.update', $edit_data->id) : route('mesin.store') }}" method="POST">
                    @csrf
                    @if ($edit_data)
                        @method('PUT')
                    @endif

                    <div class="modal-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger py-2">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama / Kode Mesin:</label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: Mesin Cuci 01" value="{{ old('kode', $edit_data->kode ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Mesin:</label>
                            <select name="kategori_id" class="form-select" required>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $edit_data->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Merek Mesin:</label>
                            <input type="text" name="merek" class="form-control" placeholder="Contoh: LG, Samsung, Electrolux" value="{{ old('merek', $edit_data->merek ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kapasitas (Kg):</label>
                            <input type="number" name="kapasitas" min="1" class="form-control" placeholder="Contoh: 10" value="{{ old('kapasitas', $edit_data->kapasitas ?? '') }}" required>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">Status Operasional:</label>
                            <select name="status" class="form-select" required>
                                @php
                                    $status_opsi = [
                                        'Ready' => 'Ready (Siap)',
                                        'Sedang Digunakan' => 'Sedang Digunakan',
                                        'Maintenance' => 'Maintenance / Perbaikan'
                                    ];
                                @endphp
                                @foreach ($status_opsi as $key => $val)
                                    <option value="{{ $key }}" {{ old('status', $edit_data->status ?? '') == $key ? 'selected' : '' }}>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer border-top">
                        @if ($edit_data)
                            <a href="{{ route('mesin.index') }}" class="btn btn-outline-dark fw-bold px-3">Batal</a>
                        @else
                            <button type="button" class="btn btn-outline-dark fw-bold px-3" data-bs-dismiss="modal">Batal</button>
                        @endif

                        <button type="submit" class="btn btn-success fw-bold px-4">
                            {{ $edit_data ? 'Update Mesin' : 'Simpan Mesin' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Otomatis buka pop-up saat tombol Edit di tabel diklik ($edit_data) atau saat validasi error --}}
    @if ($edit_data || $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalMesin = new bootstrap.Modal(document.getElementById('modalMesin'));
                modalMesin.show();
            });
        </script>
    @endif
@endsection