@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Data Produk</h1>

    <div class="card shadow-sm p-5">
        <form action="{{ route('product.update' , $products['id']) }}" method="POST">
            @csrf
            @method('PATCH')

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
                    <input type="text" class="form-control" id="name" name="name" value="{{ $products['name'] }}" placeholder="Masukkan Nama Produk">
                </div>
            </div>

            <div class="mb-4 row">
                <label for="type" class="col-sm-2 col-form-label">Jenis Produk:</label>
                <div class="col-sm-10">
                    <select class="form-select" id="type" name="type">
                        <option selected disabled hidden>Pilih Jenis Produk</option>
                        <option value="Makanan" {{ $products['type'] == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="Minuman" {{ $products['type'] == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="Peralatan Rumah Tangga" {{ $products['type'] == 'Peralatan Rumah Tangga' ? 'selected' : '' }}>Peralatan Rumah Tangga</option>
                    </select>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="price" class="col-sm-2 col-form-label">Harga Produk (Rp):</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" name="price" value="{{ $products['price'] }}" placeholder="Masukkan Harga Produk">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Perbarui Data</button>
        </form>
    </div>
</div>
@endsection
