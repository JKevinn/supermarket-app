@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Tambah Produk Baru</h1>
    
    <div class="card shadow-sm p-5">
        <form action="{{ route('product.store') }}" method="POST">
            @csrf

            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4 row">
                <label for="name" class="col-sm-2 col-form-label">Nama Produk:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Produk">
                </div>
            </div>

            <div class="mb-4 row">
                <label for="type" class="col-sm-2 col-form-label">Jenis Produk:</label>
                <div class="col-sm-10">
                    <select class="form-select" id="type" name="type">
                        <option selected disabled hidden>Pilih Jenis Produk</option>
                        <option value="Makanan" {{ old('type') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Minuman" {{ old('type') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="Peralatan Rumah Tangga" {{ old('type') == 'Peralatan Rumah Tangga' ? 'selected' : '' }}>Peralatan Rumah Tangga</option>
                    </select>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="price" class="col-sm-2 col-form-label">Harga Produk (Rp):</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Masukkan Harga Produk">
                </div>
            </div>

            <div class="mb-4 row">
                <label for="stock" class="col-sm-2 col-form-label">Stok Tersedia:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" placeholder="Masukkan Jumlah Stok">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Tambah Produk</button>
        </form>
    </div>
</div>
@endsection
