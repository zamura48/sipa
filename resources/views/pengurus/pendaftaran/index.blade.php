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
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Nama Orang Tau</th>
                            <th>Nomor Telepon</th>
                            <th>Periode</th>
                            <th>Status Konfirmasi</th>
                            <th>Keringanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pendaftaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <h6>{{ $item->nama_siswa }}</h6>
                                    <h6>NIS: <span class="badge badge-primary">{{ $item->nis }}</span></h6>
                                    <h6>Jenis Kelamin: <span
                                            class="badge badge-info">{{ $item->jenis_kelamin_siswa == 'L' ? 'Laki - Laki' : 'Perempuan' }}</span>
                                    </h6>
                                    <h6>Sekolah: <span
                                            class="badge badge-info">{{ $item->sekolah ? $item->sekolah->nama_sekolah : '' }}</span>
                                    </h6>
                                </td>
                                <td>{{ $item->nama_ortu }}</td>
                                <td>{{ $item->telepon_ortu }}</td>
                                <td>{{ $item->periode->nama }}</td>
                                @if ($item->status)
                                    <td><span class="badge badge-success">Sudah Dikonfirmasi</span></td>
                                @else
                                    <td><span class="badge badge-warning">Belum Dikonfirmasi</span></td>
                                @endif
                                <td>
                                    <ul>
                                        @foreach ($item->pendaftaran_keringanan as $key => $value)
                                            <li class="mt-3">
                                                <a href="{{ asset('pendaftaran_keringanan/' . $value->dokumen_pendukung) }}"
                                                    target="_blank">{{ $value->keringanan->nama }}
                                                </a>
                                                @if ($value->status_pengajuan == 1)
                                                    <span class="badge badge-success">Pengajuan Dikonfirmasi</span>
                                                @else
                                                    <form action="{{ route('admin.pendaftaran.konfirmasi_keringanan') }}"
                                                        method="POST" style="display:inline;"
                                                        id="confirm-{{ $value->id }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <button type="button"
                                                            class="btn btn-success btn-sm btn-konfirmasi-status-pengajuan"
                                                            data-id="{{ $value->id }}"
                                                            data-name_siswa="{{ $item->nama_siswa }}"
                                                            data-keringanan="{{ $value->keringanan->nama }}">
                                                            <i class="fa fa-check mr-2"></i> Konfirmasi Pengajuan Keringanan
                                                        </button>
                                                    </form>
                                                @endif
                                            </li>
                                            <hr>
                                        @endforeach
                                    </ul>
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

        function confirm(id, siswa_name) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data pendaftaran "' + siswa_name + '" akan dikonfirmasi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#confirm-' + id).submit();
                }
            });
        }

        $('.btn-konfirmasi-status-pengajuan').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name_siswa = $(this).data('name_siswa');
            let keringanan = $(this).data('keringanan');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Pengajuan keringanan "' + keringanan + '" atas nama "' + name_siswa +
                    '" akan dikonfirmasi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#confirm-' + id).submit();
                }
            });
        });
    </script>
@endpush
