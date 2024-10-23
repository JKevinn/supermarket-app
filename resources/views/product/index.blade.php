@extends('layouts.layout')

@section('content')
<div class="container mt-5">
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

    @if(Request::get('short_stock') == 'stock')
        <input type="hidden" name="short_stock" value="stock">
    @endif

    <div class="d-flex justify-content-end mb-3">
        <form class="me-2" role="Stock" action="{{ route('product.index') }}" method="GET">
            <input type="hidden" name="short_stock" value="stock">
            <button type="submit" class="btn btn-primary">
                Urutkan Stok <i class="fas fa-sort-amount-up-alt ms-1"></i>
            </button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="text-center bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if(count($products) < 1)
                <tr>
                    <td colspan="6" class="text-center">Data Produk Kosong</td>
                </tr>
            @else
                @foreach ($products as $index => $item)
                    <tr>
                        <td class="text-center">{{ ($products->currentpage() - 1) * $products->perPage() + ($index + 1) }}</td>
                        <td class="text-center">{{ $item['name'] }}</td>
                        <td class="text-center">{{ $item['type'] }}</td>
                        <td class="text-center">Rp. {{ number_format($item['price'], 0, ',', ',') }}</td>
                        <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : '' }} text-center text-decoration-underline" style="cursor: pointer;" onclick="showModalStock('{{ $item->id }}', '{{ $item->stock }}')">
                            {{ $item['stock'] }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('product.edit', $item['id']) }}" class="btn btn-primary m-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="btn btn-danger m-2" onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3">
        {{ $products->links() }}
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-delete-product" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus produk <span id="nama-product" class="fw-bold"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_edit_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_edit_stock" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_stock">Edit Stok Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="stock" class="form-label">Stok:</label>
                        <input type="number" name="stock" id="stock_edit" class="form-control">
                        @if (Session::get('Failed'))
                            <small class="text-danger">{{ Session::get('Failed') }}</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>

<script>
    function showModal(id, name) {
        let urlDelete = '{{ route("product.delete", ":id") }}';
        urlDelete = urlDelete.replace(':id', id);
        $('#form-delete-product').attr('action', urlDelete);
        $('#exampleModal').modal('show');
        $('#nama-product').text(name);
    }

    function showModalStock(id, stock) {
        let urlEdit = '{{ route("product.updateStock", ":id") }}';
        urlEdit = urlEdit.replace(':id', id);
        $('#form_edit_stock').attr('action', urlEdit);
        $('#stock_edit').val(stock);
        $('#modal_edit_stock').modal('show');
    }
</script>
@endpush
