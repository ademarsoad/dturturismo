
function validaEmail() {
   var email = document.forms["meuForm"].email.value;
   if (email.length < 5 || email.length > 128 || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
       alert("O campo 'Email' deve ser preenchido corretamente");
       return false;
   }
   return true;
}
