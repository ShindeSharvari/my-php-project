function checkPasswordMatch() {
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;

  if (password !== confirmPassword) {
    document.getElementById("confirmPasswordError").innerHTML = "Passwords do not match.";
    document.getElementById("confirmPassword").classList.add("is-invalid");
  } else {
    document.getElementById("confirmPasswordError").innerHTML = "";
    document.getElementById("confirmPassword").classList.remove("is-invalid");
  }
}

   // Mobile validation
   function onlyNumberKey(keyevent) {
          
    // Only ASCII character in that range allowed
    var ASCIICode = (keyevent.which) ? keyevent.which : keyevent.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
  }