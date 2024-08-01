@extends('../app')
@section('body')
@include('admin/menu')

@push('after-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

<style>
      .blink {
            animation: blinker 3s linear infinite;
        }
        @keyframes blinker {
            50% { opacity: 0; }
        }
</style>

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
                <table class="table table-bordered" id="tabelindex1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pegawai</th>
                            <th>Gol</th>
                            <th>Jabatan</th>
                            <th>P Terakhir</th>
                            <th>P Datang</th>
                            <th class="text-center" style="width: 20%">Keterangan</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            @php
                                $exp = $item->DPegawai->nip;
                                $ex1 = Str::substr($exp, 0, 8);
                                $ex2 = Str::substr($exp, 8, 6);
                                $ex3 = Str::substr($exp, 14, 1);
                                $ex4 = Str::substr($exp, 15, 3);
                                $sub = $ex1 . ' ' . $ex2 . ' ' . $ex3 . ' ' . $ex4;
                            @endphp

                            <td class="text-center" style="width:0%;">{{ $loop->iteration }}</td>
                            <td style="width:18%;">
                                @if ($item->DPegawai == null)
                                @else
                                {{ $item->DPegawai->nama }}<br><b>{{ $sub }}</b>
                                @endif

                            </td>
                            <td style="width:0%;">{{ $item->gol }}</td>
                            <td style="width:22%;">{{ strtoupper($item->jabatan) }}</td>
                            <td class="text-center" style="width:10%;">{{ date('d-m-Y', STRTOTIME($item->pangkatakhir)) }}</td>
                            <td class="text-center" style="width:10%;">{{ date('d-m-Y', STRTOTIME($item->pangkatdatang)) }}</td>
                            <td class="text-left" style="width:20%;">{{ $item->ket }}</td>
                            <td style="width:13%;">
                                @php
                                    $currentYear = (int)date('Y');
                                    $pangkatDatangYear = (new DateTime($item->pangkatdatang))->format('Y');
                                    $yearDifference = $pangkatDatangYear - $currentYear;
                                @endphp
                                @if ($yearDifference <= 1)
                                    <a class="btn">
                                        <i class="fa-regular fa-lightbulb blink" style="color:red;text-shadow: 2px 2px 5px red;font-size:20px"></i>
                                    </a>
                                @elseif ($yearDifference <= 2)
                                    <a class="btn">
                                        <i class="fa-regular fa-lightbulb blink" style="color:yellow;text-shadow: 2px 2px 5px red;font-size:20px"></i>
                                    </a>
                                @else

                                @endif

                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#{{ $item->id }}">
                                    <i class="fas fa-fw fa-pencil"></i>
                                </button>

                                <!-- Modal edit data -->
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
                        <select name="nip" class="select2 form-control" id="nip" style="width: 100%;">
                            <option selected>-- PILIH --</option>
                            @foreach ($dataPegawai as $item)

                            @php
                                $exp = $item->nip;
                                $ex1 = Str::substr($exp, 0, 8);
                                $ex2 = Str::substr($exp, 8, 6);
                                $ex3 = Str::substr($exp, 14, 1);
                                $ex4 = Str::substr($exp, 15, 3);
                                $sub = $ex1 . ' ' . $ex2 . ' ' . $ex3 . ' ' . $ex4;
                            @endphp

                            <option value="{{ $item->nip }}">{{ $sub }} || {{ $item->nama }}</option>
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

@push('after-main')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

<script>
   $(document).ready(function() {
        $(".select2").select2({
            dropdownParent: $("#addPangkat")
        });
    });

    $(document).ready(function () {
        $("#perangkat").addClass("active");
    });

</script>
<script>

    $(document).ready(function () {
        @if($errors->any())
            $('#addPangkat').modal('show');

            var errorMassage = '';
            @foreach($errors->all() as $error)
                errorMassage += '<li>{{ $error }}</li>';
            @endforeach
            $('#addPangkat .modal-body').prepend('<div class="alert alert-danger" id="alert">' + errorMassage + '</div>');
        @endif
    });

</script>
<script>
    $('#addPangkat').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    })
</script>

<script>
    $(document).ready(function() {
        $('.blink').each(function() {
                $(this).addClass('blink');
            });
    });
</script>

@endsection
