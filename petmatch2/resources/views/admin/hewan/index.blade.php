@extends('admin.layouts.app')

@section('content')
<style>
    body {
        background: #fdf8f5;
        font-family: 'Poppins', sans-serif;
    }

    /* Card Styling */
    .custom-card {
        background: #ffffff;
        border-radius: 25px;
        border: 2px solid #f3e9e2;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.05);
        padding: 20px;
    }

    .card-title-custom {
        color: #634832;
        font-weight: 800;
        position: relative;
        display: inline-block;
    }

    .card-title-custom::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 35px;
        height: 4px;
        background: #dbc1ac;
        border-radius: 10px;
    }

    /* Button Styling */
    .btn-add-hewan {
        background-color: #967e76;
        color: white;
        border-radius: 15px;
        font-weight: 700;
        border: none;
        padding: 10px 20px;
        transition: 0.3s;
    }

    .btn-add-hewan:hover {
        background-color: #634832;
        color: white;
        transform: scale(1.05);
    }

    /* Table Styling */
    .table-container {
        border-radius: 20px;
        overflow: hidden;
        margin-top: 20px;
    }

    .table thead th {
        background-color: #f3e9e2 !important;
        color: #7d5a50;
        border: none;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        color: #5d4037;
        vertical-align: middle;
        border-bottom: 1px solid #fdf8f5;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fffaf7;
    }

    /* Badge Customization */
    .badge-custom {
        padding: 6px 12px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.7rem;
    }
    
    .bg-gender-jantan { background-color: #d0e1f9; color: #4a90e2; }
    .bg-gender-betina { background-color: #f9dbe1; color: #d63384; }
    .bg-status-tersedia { background-color: #e2f0d9; color: #66bb6a; }
    .bg-status-diadopsi { background-color: #f8d7da; color: #dc3545; }
    .bg-kondisi { background-color: #ece0d1; color: #634832; }

    /* Action Buttons */
    .btn-action-edit {
        background-color: #f3e9e2;
        color: #634832;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-action-edit:hover {
        background-color: #dbc1ac;
    }

    .btn-action-delete {
        background-color: #fff;
        color: #dc3545;
        border: 1px solid #f8d7da;
        border-radius: 8px;
    }

    .btn-action-delete:hover {
        background-color: #f8d7da;
    }
</style>

<div class="container py-4">
    <div class="custom-card">
        <div class="card-body">
        
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title-custom">Data Hewan</h5>
                <a href="{{ route('admin.hewan.create') }}" class="btn btn-add-hewan shadow-sm">
                    Tambah Data Hewan
                </a>
            </div>

            <div class="table-container">
                <table id="datatable" class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Umur</th>
                            <th>Gender</th>
                            <th>Deskripsi</th> 
                            <th>Foto</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($hewans as $hewan)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $hewan->nama }}</td>
                            <td>{{ $hewan->jenis }}</td>
                            <td>{{ $hewan->umur }}</td>
                            <td>
                                <span class="badge-custom {{ $hewan->gender == 'jantan' ? 'bg-gender-jantan' : 'bg-gender-betina' }}">
                                    {{ strtoupper($hewan->gender) }}
                                </span>
                            </td>
                            <td style="font-size: 0.85rem;">
                                {{ Str::limit($hewan->deskripsi, 40) }}
                            </td>
                            <td>
                                @if ($hewan->foto)
                                    <img src="{{ asset('photos/' . $hewan->foto) }}"
                                         width="50"
                                         height="50"
                                         style="object-fit:cover"
                                         class="rounded-3 shadow-sm border border-white border-2">
                                @else
                                    <small class="text-muted">Tidak ada foto</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge-custom bg-kondisi">
                                    {{ $hewan->kondisi }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-custom {{ $hewan->status == 'diadopsi' ? 'bg-status-diadopsi' : 'bg-status-tersedia' }}">
                                    {{ strtoupper($hewan->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('admin.hewan.edit', $hewan->id) }}"
                                       class="btn btn-action-edit btn-sm px-3">
                                        Ubah
                                    </a>

                                    <form id="deleteForm{{ $hewan->id }}"
                                          action="{{ route('admin.hewan.destroy', $hewan->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-action-delete btn-sm px-3"
                                                onclick="confirmDelete({{ $hewan->id }})">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                Belum ada data hewan yang tersimpan
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            "language": {
                "search": "Cari data:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "paginate": {
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            }
        });
    });

    function confirmDelete(id) {
        swal({
            title: "Hapus data hewan?",
            text: "Data yang sudah dihapus tidak bisa dikembalikan.",
            icon: "warning",
            buttons: ["Batal", "Ya, Hapus"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endpush