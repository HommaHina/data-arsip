@extends('../app')
@section('body')
@include('admin/menu')

<div class="container-fluid">



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0 text-gray-800 font-weight-bold">UBAH PASSWORD </h3>
    </div>

    <div class="card" id="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="hero-ubah-password col-md-6">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('UbahPassword') }}" method="post">
                       @csrf
                        <div class="form-group">
                            <label for="passwordLama"><b>Password Lama*</b></label>
                            <input type="password" name="passwordLama" class="form-control" placeholder="Masukan Password Lama">
                        </div>
                       <div class="form-group">
                            <label for="passwordBaru"><b>Password Baru*</b></label>
                            <input type="password" name="passwordBaru" class="form-control" placeholder="Masukan Password Baru">
                        </div>
                       <div class="form-group">
                            <label for="konfirmasipassword"><b>Konfirmasi Password*</b></label>
                            <input type="password" name="konfirmasipassword" class="form-control" placeholder="Konfirmasi Password baru">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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
@endsection

