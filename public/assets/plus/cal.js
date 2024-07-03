function sum() {
    var txtFirstNumberValue =  (document.getElementById('jlh1').value == '' ? 0:document.getElementById('jlh1').value);
    var txtSecondNumberValue = (document.getElementById('jlh2').value == '' ? 0:document.getElementById('jlh2').value);
    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
    if (!isNaN(result)) {
       document.getElementById('total').value = result;
    }
}