@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4 w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Iuran</th>
                            {{-- <th class="d-none">Jatuh Tempo</th> --}}
                            <th>Tagihan</th>
                            <th>Bukti Bayar</th>
                            <th>Status Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }} <br>
                                    <span class="badge badge-info">
                                        NIS: {{ $item->siswa ? $item->siswa->nis : '-' }}
                                    </span>
                                </td>
                                <td>{{ $item->iuran->nama }}</td>
                                {{-- <td class="d-none">{{ $item->jatuh_tempo }}</td> --}}
                                <td>{{ $item->total_semua }}</td>
                                <td>
                                    @if ($item->bukti_bayar)
                                        <a href="{{ asset('bukti_bayar/' . $item->bukti_bayar) }}" target="_blank"
                                            class="btn btn-info">Lihat Foto</a>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge badge-warning">Sudah Bayar</span>
                                    @elseif ($item->status == 2)
                                        <span class="badge badge-success">Dikonfirmasi Admin</span>
                                    @elseif ($item->status == 3)
                                        <span class="badge badge-danger">Pembayaran Ditolak</span>
                                    @elseif ($item->status == 4)
                                        <span class="badge badge-info">Bayar Ulang</span>
                                    @else
                                        <span class="badge badge-secondary">Belum Bayar</span>
                                    @endif
                                    @if ($item->status >= 3)
                                        <span class="badge badge-danger">Alasan ditolak: {{ $item->alasan }}</span> <br>
                                    @endif
                                </td>
                                <td class="">
                                    @if ($item->status == 1 || $item->status == 4)
                                        <form action="{{ route('admin.tagihan.konfirmasi_pembayaran', $item->id) }}"
                                            method="POST" style="display:inline;" id="bayar-form-{{ $item->id }}">
                                            @csrf
                                            <button type="button" class="btn btn-primary btn-sm"
                                                onclick="confirm_bayar({{ $item->id }})">
                                                <i class="fa fa-check mr-2"></i> Konfirmasi Bayar
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="tolak_bayar({{ $item->id }}, '{{ $item->siswa ? $item->siswa->nama : '-' }}')">
                                            <i class="fa fa-times-circle mr-2"></i> Tolak Pembayaran
                                        </button>
                                    @endif
                                </td>
                            </tr>


                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Pembayaran - <span
                                                    id="siswa_name"></span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.tagihan.tolak_pembayaran', $item->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id">
                                                <div class="form-group">
                                                    <label for="">Alasan Ditolak</label>
                                                    <textarea name="alasan" id="alasan" class="form-control" cols="30" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

        function confirm_bayar(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pembayaran ini akan dikonfirmasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#bayar-form-' + id).submit();
                }
            });
        }

        function tolak_bayar(id, name) {
            $("#id").val(id);
            $("#siswa_name").text(name)
            $("#exampleModal" + id).modal('show');
        }
    </script>
@endpush
