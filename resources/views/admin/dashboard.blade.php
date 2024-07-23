@extends('../app')
@section('body')
@include('admin/menu')

<div class="container-fluid">

  
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
