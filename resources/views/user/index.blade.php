@extends('layouts.layout')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="container h-50">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Kelola Akun Pengguna</h2>
            <div class="d-flex">
                <a href="{{ route('user.create') }}" class="btn btn-primary me-3">Tambah Akun</a>
                <form class="d-flex" role="search" action="{{ route('user.index') }}" method="GET">
                    <input type="text" class="form-control me-2" placeholder="Cari Akun" aria-label="Search" name="search_name" value="{{ request('search_name') }}">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <table class="table table-hover table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) < 1)
                    <tr>
                        <td colspan="5" class="text-center text-muted">Data Akun Kosong</td>
                    </tr>
                @else
                    @foreach ($users as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td class="text-center">{{ $item['role'] == 'admin' ? 'Admin' : 'Kasir' }}</td>
                            <td class="text-center">
                                <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-warning me-2">Edit</a>
                                <button class="btn btn-danger" onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        {{-- Modal Hapus --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-delete-user" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Akun Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus akun <span id="nama"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let urlDelete = '{{ route('user.delete', ':id') }}';
            urlDelete = urlDelete.replace(":id", id);
            $('#form-delete-user').attr('action', urlDelete);
            $('#exampleModal').modal('show');
            $('#nama').text(name);
        }
    </script>
@endpush
