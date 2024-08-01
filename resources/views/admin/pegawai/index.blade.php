@extends('../app')
@section('body')
@include('admin/menu')

<div class="container-fluid">



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 font-weight-bold">DATA PEGAWAI </h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPegawai">
            <i class="fa-solid fa-square-plus"></i> Tambahkan Data
        </button>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabelindex1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th class="text-left">NIP</th>
                            <th class="text-center">No HP</th>
                            <th>Alamat</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data as $item)

                        @php
                            $exp = $item->nip;
                            $ex1 = Str::substr($exp, 0, 8);
                            $ex2 = Str::substr($exp, 8, 6);
                            $ex3 = Str::substr($exp, 14, 1);
                            $ex4 = Str::substr($exp, 15, 3);
                            $sub = $ex1 . ' ' . $ex2 . ' ' . $ex3 . ' ' . $ex4;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td style="width:10%">
                                @if ($item->pasfoto)
                                    <img  src="{{ asset('storage/' . $item->pasfoto) }}" alt="foto" style="height: 130px;max-height:130px">
                                @else

                                @endif
                            </td>
                            <td style="width:20%">{{ $item->nama }}</td>
                            <td style="width:18%" class="text-left">{{ $sub }}</td>
                            <td style="width:10%" class="text-left">{{ $item->nohp }}</td>
                            <td class="text-left">{{ $item->alamat }}</td>
                            <td style="width:15%;text-align: center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#{{ $item->id }}">
                                    <i class="fas fa-fw fa-pencil"></i>
                                </button>


                                <!-- Modal edit data -->
                                <div class="modal fade" id="{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="EditPegawaiLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditPegawaiLabel">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <form action="{{ route('pegawai.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="pasfotolama" id="pasfotolama" value="{{ $item->pasfoto }}">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6 d-flex justify-content-center">
                                                            <div class="mb-3 background-image border rounded">
                                                                @if ($item->pasfoto)
                                                                    <img id="foto1" src="{{ asset('storage/' . $item->pasfoto) }}">
                                                                @else
                                                                    <img id="foto1">
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6 d-flex justify-content-center align-items-center">
                                                            <div class="mb-3 pasfotobg">
                                                                <input class="pasfoto form-control-file" type="file" id="pasfoto" name="pasfoto" accept=".jpg, .jpeg" onchange="imageUpload(this);">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nip" class="">NIP <span class="text-danger text-sm" style="font-size: 12px">( Tidak Perlu Spasi )</span></label>
                                                        <input type="text" class="form-control" id="pasfoto" name="nip" value="{{ $item->nip }}" placeholder="Masukan Nip Pegawai. . .">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama" class="">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->nama }}"
                                                        placeholder="Masukan Nama Pegawai. . .">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nohp" class="">No HP</label>
                                                        <input type="text" class="form-control" id="pasfoto" name="nohp" value="{{ $item->nohp }}" placeholder="Masukan NO HP. . .">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <textarea class="form-control" name="alamat" placeholder="Alamat. . ." rows="3">{{ $item->alamat }}</textarea>
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

                                <a href="{{ route('pegawai.show', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>

                                <a href="{{ route('pegawai.destroy', $item->id) }}" class="btn btn-danger btn-sm"
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
<div class="modal fade" id="addPegawai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPegawaiLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pegawai.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6 col-md-6 d-flex justify-content-center">
                            <div class="mb-3 background-image border rounded">
                                <img id="foto">
                            </div>
                        </div>
                        <div class="col-6 col-md-6 d-flex justify-content-center align-items-center">
                            <div class="mb-3 pasfotobg">
                                <input class="pasfoto form-control-file" type="file" id="pasfoto" name="pasfoto" accept=".jpg, .jpeg" onchange="image_preview(this);">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nip" class="form-control-label">NIP <span class="text-danger text-sm" style="font-size: 12px">( Tidak Perlu Spasi )</span></label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan Nip Pegawai. . .">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-control-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Pegawai. . .">
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-control-label">No HP</label>
                        <input type="text" class="form-control" id="pasfoto" name="nohp" placeholder="Masukan NO HP. . .">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="Alamat. . ." rows="3"></textarea>
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
        $("#pegawai").addClass("active");
    });

</script>

{{-- modal trigger error ketika tampil --}}
<script>
    $(document).ready(function () {
        @if($errors->any())
            $('#addPegawai').modal('show');

            var errorMassage = '';
            @foreach($errors->all() as $error)
                errorMassage += '<li>{{ $error }}</li>';
            @endforeach
            $('#addPegawai .modal-body').prepend('<div class="alert alert-danger" id="alert">' + errorMassage + '</div>');
        @endif
    });

</script>

{{-- trigger reset inputan ketika tutup modal --}}
<script>
        $('#addPegawai').on('hidden.bs.modal', function () {
            $('#alert').hide();
            $('#foto').attr('src', '');
            $(this).find('form').trigger('reset');
        })
</script>

{{-- modal tambah --}}
<script>
    var outImage ="foto";
    function image_preview(obj)
    {
            if (FileReader)
            {
                var reader = new FileReader();
                reader.readAsDataURL(obj.files[0]);
                reader.onload = function (e) {
                var image=new Image();
                image.src=e.target.result;
                image.onload = function () {
                    document.getElementById(outImage).src=image.src;
                };
                }
            }
    }
</script>

{{-- modal edit --}}
<script>
    var gambar ="foto1";
    function imageUpload(obj)
    {
            if (FileReader)
            {
                var reader = new FileReader();
                reader.readAsDataURL(obj.files[0]);
                reader.onload = function (e) {
                var image=new Image();
                image.src=e.target.result;
                image.onload = function () {
                    document.getElementById(gambar).src=image.src;
                };
                }
            }
    }


</script>

@endsection
