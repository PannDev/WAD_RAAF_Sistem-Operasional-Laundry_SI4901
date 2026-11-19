@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000px;">

        <header class="p-4 mb-4 bg-primary text-white rounded-3 shadow-sm text-center">
            <h1 class="h3 fw-bold mb-1">Sistem Operasional Laundry</h1>
            <p class="mb-0 text-white-50">Modul Mesin & Peralatan (Individu B)</p>
        </header>

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

        {{-- Form Tambah / Edit Mesin --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h2 class="h5 text-primary pb-2 border-bottom mb-3">
                    {{ $edit_data ? 'Edit Data Mesin' : 'Tambah Mesin Baru' }}
                </h2>

                <form action="{{ $edit_data ? route('mesin.update', $edit_data->id) : route('mesin.store') }}"
                    method="POST">
                    @csrf
                    @if ($edit_data)
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama / Kode Mesin:</label>
                        <input type="text" name="kode" class="form-control" placeholder="Contoh: Mesin Cuci 01"
                            value="{{ old('kode', $edit_data->kode ?? '') }}" required>
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
                        <input type="text" name="merek" class="form-control" placeholder="Contoh: LG, Samsung, Electrolux"
                            value="{{ old('merek', $edit_data->merek ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kapasitas (Kg):</label>
                        <input type="number" name="kapasitas" min="1" class="form-control" placeholder="Contoh: 10"
                            value="{{ old('kapasitas', $edit_data->kapasitas ?? '') }}" required>
                    </div>

                    <div class="mb-3">
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

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-bold px-4">
                            <i class="bi bi-save me-1"></i> {{ $edit_data ? 'Update Mesin' : 'Simpan Mesin' }}
                        </button>
                        @if ($edit_data)
                            <a href="{{ route('mesin.index') }}" class="btn btn-secondary fw-bold px-3">Batal</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Daftar Mesin --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="h5 text-primary pb-2 border-bottom mb-3">Daftar Inventaris Mesin</h2>

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
                                            <span class="badge bg-success">Ready</span>
                                        @elseif ($row->status == 'Sedang Digunakan')
                                            <span class="badge bg-warning text-dark">Sedang Digunakan</span>
                                        @else
                                            <span class="badge bg-danger">Maintenance</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('mesin.edit', $row->id) }}"
                                            class="btn btn-warning btn-sm fw-bold px-2 py-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('mesin.destroy', $row->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm fw-bold px-2 py-1">
                                                <i class="bi bi-trash"></i> Hapus
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
@endsection