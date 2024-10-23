@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm p-5">
            <h2 class="mb-4 text-center text-primary">Tambah Akun Pengguna</h2>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $errors)
                                <li>{{ $errors }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama pengguna">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email pengguna">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password pengguna">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="role" class="col-sm-2 col-form-label">Role:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="role" name="role">
                            <option selected disabled hidden>Pilih Role Pengguna</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Kasir</option>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">Tambah Akun</button>
                </div>
            </form>
        </div>
    </div>
@endsection
