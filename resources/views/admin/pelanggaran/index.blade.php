@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="m-0 font-weight-bold text-primary" id="card-name">Tambah Siswa Pelanggaran</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pelanggaran.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="siswa">Siswa</label>
                            <select name="siswa" id="siswa" class="form-control js-select2">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswas as $item)
                                    <option value="{{ $item->id }}" {{ old('siswa') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('siswa'))
                                <div class="invalid-feedback">{{ $errors->first('siswa') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control js-select2">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="1" {{ old('kategori') == 1 ? 'selected' : '' }}>Ringan</option>
                                <option value="2" {{ old('kategori') == 2 ? 'selected' : '' }}>Sedang</option>
                                <option value="3" {{ old('kategori') == 3 ? 'selected' : '' }}>Berat</option>
                            </select>
                            @if ($errors->has('kategori'))
                                <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" cols="30" rows="5">{{ old('catatan') }}</textarea>
                            @if ($errors->has('catatan'))
                                <div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.pelanggaran.index') }}" class="btn btn-warning">Kosongkan</a>
                    <button type="submit" class="btn btn-success ml-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Kategori</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa->nama }}</td>
                                @php
                                    $kategori = '';
                                    switch ($item->kategori) {
                                        case 1:
                                            $kategori = 'Ringan';
                                            break;
                                        case 2:
                                            $kategori = 'Sedang';
                                            break;
                                        case 3:
                                            $kategori = 'Berat';
                                            break;
                                        default:
                                            break;
                                    }
                                @endphp
                                <td>{{ $kategori }}</td>
                                <td>{{ $item->catatan }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-ubah" data-id="{{ $item->id }}" data-siswa="{{ $item->siswa_id }}" data-catatan="{{ $item->catatan }}" data-kategori="{{ $item->kategori }}">
                                        <i class="fa fa-info mr-2"></i> Ubah
                                    </button>
                                    <form action="{{ route('admin.pelanggaran.destroy', $item->id) }}" method="POST"
                                        style="display:inline;" id="delete-form-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirm_delete({{ $item->id }})">
                                            <i class="fa fa-trash mr-2"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                }
            })
        });

        function confirm_delete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        }

        $(".btn-ubah").click(function (e) {
            e.preventDefault();
            let this_id = $(this).data('id');
            let this_siswa = $(this).data('siswa');
            let this_kategori = $(this).data('kategori');
            let this_catatan = $(this).data('catatan');

            $("#id").val(this_id);
            $("#siswa").val(this_siswa).trigger('change');
            $("#kategori").val(this_kategori).trigger('change');
            $("#catatan").val(this_catatan);

            $("#card-name").text("Ubah Siswa Pelanggaran");
        });
    </script>
@endpush
