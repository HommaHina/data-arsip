@extends('../app')
@section('body')
@include('admin/menu')

        <div class="container-fluid">
            
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0 text-gray-800 font-weight-bold">DATA PENGGUNA</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
                                    <th>ID Pengguna</th>
                                    <th>Nama Pengguna</th>
                                    <th>Alamat</th>
                                    <th>Nomor Handpone</th>
                                    <th>Level</th>
                                    <th>Bidang</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                            <?php $no=1;  foreach ($data_user as $u) {?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $u['username']; ?></td>
                                            <td><?= strtoupper($u['user_nama']); ?></td>
                                            <td><?= strtoupper($u['user_alamat']); ?></td>
                                            <td><?= strtoupper($u['user_hp']); ?></td>
                                            <td><?php 
                                            $cbidang = $u['level'];
                                            if($cbidang == "21"){ echo "Admin Aplikasi | Egov";  }
                                            if($cbidang == "22"){ echo "Admin Jaringan | Egov";  }
                                            if($cbidang == "23"){ echo "Kabid | Egov";  } 
                                            if($cbidang == "3"){ echo "Admin | IKP";  } 
                                            if($cbidang == "31"){ echo "Kabid | IKP";  }
                                            if($cbidang == "4"){ echo "Admin | Persandian";  }
                                            if($cbidang == "41"){ echo "Kabid | Persandian";  } 
                                            if($cbidang == "5"){ echo "Sekretariat";  }
                                            if($cbidang == "6"){ echo "Kepala Dinas";  }
                                            ?></td>
                                            <td><?= strtoupper($u['bidang']); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <form method="post" action="{{ route('pengguna.tambah') }}">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5><b> <?php $m_id='ID'.rand();?></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="username" class="form-control mb-2" placeholder="ID Pengguna" value="<?= $m_id ?>" readonly >
                    <input type="text" name="user_nama" class="form-control mb-2" placeholder="Nama Pengguna" >
                    <Textarea class="form-control mb-2 font-weight-bold" name="user_alamat" placeholder="Alamat"></Textarea>
                    <input type="text" name="user_hp" class="form-control mb-2" placeholder="Nomor Handpone" >
                    <select name="bidang" class="form-control mb-2 font-weight-bold">
                        <option disabled selected hidden >-- Pilih Bidang --</option>
                        <option value="egovap">Egov Admin Aplikasi</option>
                        <option value="egovaj">Egov Admin Jaringan</option>
                        <option value="egovkabid">Egov Kabid</option>
                        {{-- <option value="egovsekre">Egov Sekretariat</option> --}}
                        <option value="ikp">IKP</option>
                        <option value="ikpkabid">IKP Kabid</option>
                        {{-- <option value="ikpsekre">IKP Sekretariat</option> --}}
                        <option value="persandian">Persandian</option>
                        <option value="persandiankabid">Persandian Kabid</option>
                        {{-- <option value="persandiansekre">Persandian Sekretariat</option> --}}
                        <option value="sekre">Sekretariat</option>
                        <option value="kadis">Kepala Dinas</option>
                    </select> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </div>
            </form>
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
    $(document).ready(function(){
        $("#pengguna").addClass("active");
        // $("#pengguna1").addClass("show");
        // $("#sub").addClass("active");
    //   document.getElementById("#sub2").style.color = '#0036FF';
    });
</script>
@endsection