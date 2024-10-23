@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm p-5">
            <h2 class="mb-4 text-center text-primary">Perbarui Data Akun</h2>

            <form action="{{ route('user.update', $users['id']) }}" method="POST">
                @csrf
                @method('PATCH')

                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $users['name'] }}" placeholder="Masukkan nama pengguna">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $users['email'] }}" placeholder="Masukkan email pengguna">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" value="{{ $users['password'] }}" placeholder="Masukkan password baru (opsional)">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="role" class="col-sm-2 col-form-label">Role:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="role" name="role">
                            <option disabled hidden>Pilih Role Pengguna</option>
                            <option value="admin" {{ $users['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="cashier" {{ $users['role'] == 'cashier' ? 'selected' : '' }}>Kasir</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection
