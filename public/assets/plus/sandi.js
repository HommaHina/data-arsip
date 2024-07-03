$(function () {
    $("#btnSubmit").click(function () {
        var password = $("#txtPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        if (password != confirmPassword) {
            alert("Kata Sandi Tidak Sama");
            return false;
        }
        return true;
    });
});