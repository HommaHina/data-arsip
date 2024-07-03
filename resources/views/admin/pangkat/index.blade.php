@extends('../app')
@section('body')
@include('admin/menu')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 font-weight-bold">DATA PANGKAT</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPangkat">
            <i class="fa-solid fa-square-plus"></i> Tambahkan Data
        </button>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabelindex1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pegawai</th>
                            <th>Jabatan</th>
                            <th>Pangkat Terakhir</th>
                            <th>Pangkat Datang</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->DPegawai->nama }}<br><b>{{ $item->DPegawai->nip }}</b></td>
                            <td>{{ strtoupper($item->jabatan) }}</td>
                            <td class="text-center">{{ date('d-m-Y', STRTOTIME($item->pangkatakhir)) }}</td>
                            <td class="text-center">{{ date('d-m-Y', STRTOTIME($item->pangkatdatang)) }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#{{ $item->id }}">
                                    <i class="fas fa-fw fa-pencil"></i>
                                </button>

                                <!-- Modal tambah data -->
                                <div class="modal fade" id="{{ $item->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPangkatLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPangkatLabel">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('pangkat.update',$item->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nip" class="form-control-label">NIP</label>
                                                        <select name="nip" class="form-control" id="nip">
                                                            <option selected>-- PILIH --</option>
                                                            @foreach ($dataPegawai as $itemP)
                                                            <option value="{{ $itemP->id }}"
                                                                {{ $itemP->id == $item->nip ? 'selected' : '' }}
                                                                >{{ $itemP->nip }} ||
                                                                {{ $itemP->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jabatan" class="form-label">Jabatan</label>
                                                        <input type="text" name="jabatan" class="form-control"
                                                            id="jabatan" placeholder="Masukan Jabatan. . ." value="{{ $item->jabatan }}">
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label for="gol" class="form-label">Golongan</label>
                                                            <input type="text" class="form-control" id="gol" name="gol" value="{{ $item->gol }}" placeholder="Golongan. . .">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="pangkatakhir" class="form-label">Pangkat
                                                                Akhir</label>
                                                            <input type="date" class="form-control" id="pangkatakhir" value="{{ $item->pangkatakhir }}"
                                                                name="pangkatakhir">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="pangkatdatang" class="form-label">Pangkat
                                                                Datang</label>
                                                            <input type="date" class="form-control" id="pangkatdatang" value="{{ $item->pangkatdatang }}"
                                                                name="pangkatdatang">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="pangkatdatang" class="form-label">Keterangan</label>
                                                        <textarea class="form-control" name="ket"
                                                            placeholder="Keterangan. . ." rows="3">{{ $item->ket }}</textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <a href="{{ route('pangkat.show', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a> --}}

                                <a href="{{ route('pangkat.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                                    data-confirm-delete="true">
                                    <i class="fas fa-fw fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal tambah data -->
<div class="modal fade" id="addPangkat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addPangkatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPangkatLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nip" class="form-control-label">NIP</label>
                        <select name="nip" class="form-control" id="nip">
                            <option selected>-- PILIH --</option>
                            @foreach ($dataPegawai as $item)
                            <option value="{{ $item->id }}">{{ $item->nip }} || {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" id="jabatan"
                            placeholder="Masukan Jabatan. . .">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="gol" class="form-label">Golongan</label>
                            <input type="text" class="form-control" id="gol" name="gol" placeholder="Golongan. . .">
                        </div>
                        <div class="col-md-4">
                            <label for="pangkatakhir" class="form-label">Pangkat Akhir</label>
                            <input type="date" class="form-control" id="pangkatakhir" name="pangkatakhir">
                        </div>
                        <div class="col-md-4">
                            <label for="pangkatdatang" class="form-label">Pangkat Datang</label>
                            <input type="date" class="form-control" id="pangkatdatang" name="pangkatdatang">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pangkatdatang" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="ket" placeholder="Keterangan. . ." rows="3"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Dinas Kominfo Barito Kuala 2024</span>
        </div>
    </div>
</footer>
</div>
</body>
@endsection

@section ('active')
<script>
    $(document).ready(function () {
        $("#pengguna").addClass("active");
        // $("#pengguna1").addClass("show");
        // $("#sub").addClass("active");
        //   document.getElementById("#sub2").style.color = '#0036FF';
    });

</script>
@endsection
