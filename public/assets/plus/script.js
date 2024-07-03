$(document).ready(function() {
  $('#tabel1').DataTable( {
      "language": {
      "sProcessing":   "Sedang memproses...",
      "sLengthMenu":   "",
      "sZeroRecords":  "Tidak ditemukan data yang sesuai",
      "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
      "sInfoPostFix":  "",
      "sSearch":       "Pencarian Data : ",
      "sUrl":          "",
      "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
      }
            }
        } );
    } );

$(document).ready(function() {
  $('#tabel2').DataTable( {
      "searching": false,
      "language": {
      "sProcessing":   "Sedang memproses...",
      "sLengthMenu":   "<?=$menutabel2?>",
      "sZeroRecords":  "Tidak ditemukan data yang sesuai",
      "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
      "sInfoPostFix":  "",
      "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
      }
            }
        } );
    } );

$(document).ready(function() {
  $('#tabel3').DataTable( {
      "language": {
      "sProcessing":   "Sedang memproses...",
      "sLengthMenu":   "<a href='#' style='background-color:#ffc73c; border-color:#ffc73c;' class='btn btn-secondary float-right' data-toggle='modal' data-target='#tambah'><i class='fa fa-plus'></i> Tambah</a>",
      "sZeroRecords":  "Tidak ditemukan data yang sesuai",
      "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
      "sInfoPostFix":  "",
      "sSearch":       "Pencarian Data : ",
      "sUrl":          "",
      "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
      }
            }
        } );
    } );

for(let i = 0; i < 10; i++){
$(document).ready(function() {
  $('#tabelindex'+i).DataTable( {
      "lengthMenu": [ 5, 10, 20, 40, 80, 100 ],
      "language": {
      "sProcessing":   "Sedang memproses...",
      "sLengthMenu":   "Tampil _MENU_ Baris",
      "sZeroRecords":  "Tidak ditemukan data yang sesuai",
      "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
      "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
      "sInfoPostFix":  "",
      "sSearch":       "Pencarian Data : ",
      "sUrl":          "",
      "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
      }
            }
        } );
    } );}
function cekantrian(){
    var nik = $("#nik").val();
    $.ajax({
        url: 'ajax.php',
        data:"nik="+nik,
    }).success(function (data) {
        var json = data, 
        obj = JSON.parse(json);
        $('#nama').val(obj.nama);
        $('#umur').val(obj.umur);
        $('#jeniskelamin').val(obj.jeniskelamin);
        $('#alamat').val(obj.alamat);
        var nama = document.getElementById("nama").value;
        var umur = document.getElementById("umur").value;
        var jk = document.getElementById("jeniskelamin").value;
        var alamat = document.getElementById("alamat").value;
        if (jk == 'Perempuan'){ document.getElementById("pilih2").selected=true;} else if (jk == 'Laki-laki'){ document.getElementById("pilih1").selected=true;} else if (jk == ''){ document.getElementById("pilih").selected=true;}
        if (nama !== ''){ document.getElementById("nama").setAttribute("readonly", true); } else {document.getElementById("nama").removeAttribute("readonly");}
        if (umur !== ''){ document.getElementById("umur").setAttribute("readonly", true); } else {document.getElementById("umur").removeAttribute("readonly");}
        if (jk !== ''){ document.getElementById("jeniskelamin").setAttribute("disabled", true); } else {document.getElementById("jeniskelamin").removeAttribute("disabled");}
        if (alamat !== ''){ document.getElementById("alamat").setAttribute("readonly", true); } else {document.getElementById("alamat").removeAttribute("readonly");}
        if (nama !== ''){ document.getElementById("ada").value = 'ada'; } else {document.getElementById("ada").value = '';}
    });
}
