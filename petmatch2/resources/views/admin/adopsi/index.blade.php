@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">Permintaan Adopsi</h4>

    <table class="table table-bordered">
        <tr>
            <th>User</th>
            <th>Hewan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($adopsis as $a)
        <tr>
            <td>{{ $a->user->name }}</td>
            <td>{{ $a->hewan->nama }}</td>
            <td>{{ $a->status }}</td>
            <td>
                @if($a->status == 'pending')
                <form action="{{ route('admin.adopsi.approve',$a) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-success">Setujui</button>
                </form>

                <form action="{{ route('admin.adopsi.reject',$a) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm btn-danger">Tolak</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
