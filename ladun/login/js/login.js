const urlLoginProses = document.getElementById('txtHomebase').value+"login/prosesLogin";
const awalLogin = true;

$(document).ready(function(){
  document.getElementById("txtUsername").focus();
});

console.log(urlLoginProses);

var loginForm = new Vue({
  el: "#login-app",
  data: {
    userInput: "",
    passwordInput: ""
  },
  methods: {
    klikSaya: function() {
      if (this.userInput === "" || this.passwordInput === "") {
        isiField();
      } else {
        let xhr = new XMLHttpRequest();
        let params = "username="+this.userInput+"&password="+this.passwordInput;
        xhr.open('POST', urlLoginProses, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
          let obj = JSON.parse(this.responseText);
          console.log(obj);
            if (obj.status_login === 'sukses') {
              suksesLogin();
            } else {
              gagalLogin(); 
            }
        }

        xhr.send(params);
               
      }
    }
  }
});

// let data = { username : }

function suksesLogin() {
  iziToast.info({
    title: "Sukses",
    message: "Berhasil login, ke halaman dasbor",
    position: "topCenter",
    timeout: 1000,
    pauseOnHover: false,
    onClosed: function() {
      window.location.assign('dasbor');
    }
  });
}

function gagalLogin() {
  iziToast.error({
    title: "Gagal",
    message: "Username / Password salah!!",
    position: "topCenter",
    timeout: 1000,
    pauseOnHover: false,
    onClosed: function() {
      clearForm();
    }
  });
}

function isiField() {
  iziToast.warning({
    title: "Isi Field!!",
    message: "Masukkan username & Password",
    position: "topCenter",
    timeout: 2000,
    pauseOnHover: false,
    onClosed: function() {
      clearForm();
    }
  });
}

function clearForm() {
  document.getElementById("txtUsername").value = "";
  document.getElementById("txtPassword").value = "";
  document.getElementById("txtUsername").focus();
}
