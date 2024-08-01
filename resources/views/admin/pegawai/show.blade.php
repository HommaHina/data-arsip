@extends('../app')
@section('body')
@include('admin/menu')

<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tes">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="{{ asset('storage/' . $data->pasfoto) }}"
                                    alt="" style="height: 250px;max-height:250px">
                            </div>
                            <div class="col-md-8">
                                @php
                                    $exp = $data->nip;
                                    $ex1 = Str::substr($exp, 0, 8);
                                    $ex2 = Str::substr($exp, 8, 6);
                                    $ex3 = Str::substr($exp, 14, 1);
                                    $ex4 = Str::substr($exp, 15, 3);
                                    $sub = $ex1 . ' ' . $ex2 . ' ' . $ex3 . ' ' . $ex4;
                                @endphp
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:1%">NIP</th>
                                        <td style="width:1%">:</td>
                                        <td>{{ $sub }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $data->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>No HP</th>
                                        <td>:</td>
                                        <td>{{ $data->nohp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ $data->alamat }}</td>
                                    </tr>
                                </table>


                            </div>
                        </div>
                        {{-- pangkat --}}
                        <div class="pangkat mt-4">
                            <h5>Pangkat</h5>
                            @if ($data->data_pangkat == null)
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:30%">Jabatan</th>
                                    <td style="width:1%">:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Gol</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Pangkat Akhir</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Pangkat Datang</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </table>

                            @else
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:30%">Jabatan</th>
                                    <td style="width:1%">:</td>
                                    <td>{{ $data->data_pangkat->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>Gol</th>
                                    <td>:</td>
                                    <td>{{ $data->data_pangkat->gol }}</td>
                                </tr>
                                <tr>
                                    <th>Pangkat Akhir</th>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($data->data_pangkat->pangkatakhir)) }}</td>
                                </tr>
                                <tr>
                                    <th>Pangkat Datang</th>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($data->data_pangkat->pangkatdatang)) }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>:</td>
                                    <td>{{ $data->data_pangkat->ket }}</td>
                                </tr>
                            </table>
                            @endif

                        </div>

                        {{-- berkala --}}
                        <div class="pangkat mt-4">
                            <h5>Berkala</h5>
                            @if ($data->data_berkala == null)
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width:30%">Jabatan</th>
                                        <td style="width:1%">:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Berkala Akhir</th>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Berkala Datang</th>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>:</td>
                                        <td></td>
                                    </tr>
                                </table>
                            @else
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:30%">Jabatan</th>
                                    <td style="width:1%">:</td>
                                    <td>{{ $data->data_berkala->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>Berkala Akhir</th>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($data->data_berkala->berkalaakhir)) }}</td>
                                </tr>
                                <tr>
                                    <th>Berkala Datang</th>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($data->data_berkala->berkaladatang)) }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>:</td>
                                    <td>{{ $data->data_berkala->ket }}</td>
                                </tr>
                            </table>
                            @endif

                        </div>

                    </div>
                </div>
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
@endsection
