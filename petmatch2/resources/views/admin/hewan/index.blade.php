@extends('admin.layouts.app')

@section('css')
    {{-- CSS tambahan jika perlu --}}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
    
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold">Data Hewan</h5>
            <a href="{{ route('admin.hewan.create') }}" class="btn btn-primary">
                + Tambah Data Hewan
            </a>
        </div>

        <div class="table-responsive">
            <table id="datatable" class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Umur</th>
                        <th>Foto</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($hewans as $hewan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hewan->nama }}</td>
                        <td>{{ $hewan->jenis }}</td>
                        <td>{{ $hewan->umur }} tahun</td>

                        <td>
                            @if ($hewan->foto)
                                <img src="{{ asset('photos/' . $hewan->foto) }}"
                                     width="60"
                                     class="rounded shadow-sm">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>

                        <td>
                            <span class="badge bg-success">
                                {{ $hewan->kondisi }}
                            </span>
                        </td>

                        <td>
                            <span class="badge 
                                {{ $hewan->status == 'diadopsi' ? 'bg-danger' : 'bg-secondary' }}">
                                {{ $hewan->status }}
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.hewan.edit', $hewan->id) }}"
                               class="btn btn-warning btn-sm">
                                Ubah
                            </a>

                            <form id="deleteForm{{ $hewan->id }}"
                                  action="{{ route('admin.hewan.destroy', $hewan->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $hewan->id }})">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Data hewan belum tersedia
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });

    function confirmDelete(id) {
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endsection
