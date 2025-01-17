@extends('layouts.master')
@section('title')
    Data Barang
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('page-title')
    Data Stok Barang
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">List Data Barang</h4>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addBarangModal">
                                <i class="mdi mdi-plus me-1"></i> Tambah Data Barang
                            </a>
                        </div>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_barang as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>
                                        <button
                                            class="px-2 text-primary border-0 bg-transparent"
                                            title="Edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editBarangModal"
                                            data-id="{{ $barang->id }}"
                                            data-kode="{{ $barang->kode_barang }}"
                                            data-nama="{{ $barang->nama_barang }}"
                                            data-harga="{{ $barang->harga }}"
                                            data-stok="{{ $barang->stok }}">
                                            <i class="ri-pencil-line font-size-18"></i>
                                        </button>
                                        <form action="{{ route('delete-barang', $barang->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $barang->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="px-2 text-danger border-0 bg-transparent" title="Delete" onclick="confirmDelete({{ $barang->id }})">
                                                <i class="ri-delete-bin-line font-size-18"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <!-- Modal -->
        <div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBarangModalLabel">Tambah Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- end modalheader -->
                    <div class="modal-body p-4">
                        <form action="{{ url('/data-barang') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Masukkan Kode Barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" class="form-control" id="harga_barang" name="harga_barang" placeholder="Masukkan Harga Barang" required>
                            </div>
                            <div class="mb-3">
                                <label for="stok_barang" class="form-label">Stok Barang</label>
                                <input type="number" class="form-control" id="stok_barang" name="stok_barang" placeholder="Masukkan Stok Barang" required>
                            </div>
                    </div>
                    <!-- end modalbody -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-sm">Add</button>
                    </div>
                        </form>
                    <!-- end modalfooter -->
                </div><!-- end content -->
            </div>
        </div>
        <!-- end modal -->

        <!-- Modal -->
        <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBarangModalLabel">Edit Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- end modalheader -->
                    <div class="modal-body p-4">
                        <form id="editBarangForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" id="edit_kode_barang" name="kode_barang">
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="edit_nama_barang" name="nama_barang">
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" class="form-control" id="edit_harga_barang" name="harga_barang">
                            </div>
                            <div class="mb-3">
                                <label for="stok_barang" class="form-label">Stok Barang</label>
                                <input type="number" class="form-control" id="edit_stok_barang" name="stok_barang">
                            </div>
                    </div>
                    <!-- end modalbody -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light w-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary w-sm">Update</button>
                    </div>
                    </form>
                    <!-- end modalfooter -->
                </div><!-- end content -->
            </div>
        </div>
        <!-- end modal -->
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
    @endsection
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
    const editBarangModal = document.getElementById('editBarangModal');

    editBarangModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;

        // Ambil data dari atribut data-*
        const id = button.getAttribute('data-id');
        const kode = button.getAttribute('data-kode');
        const nama = button.getAttribute('data-nama');
        const harga = button.getAttribute('data-harga');
        const stok = button.getAttribute('data-stok');

        // Isi field modal dengan data yang sesuai
        document.getElementById('edit_kode_barang').value = kode;
        document.getElementById('edit_nama_barang').value = nama;
        document.getElementById('edit_harga_barang').value = harga;
        document.getElementById('edit_stok_barang').value = stok;

        // Atur action URL pada form untuk update
        const form = document.getElementById('editBarangForm');
        form.action = `/data-barang/update/${id}`;
    });
});


            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endsection
