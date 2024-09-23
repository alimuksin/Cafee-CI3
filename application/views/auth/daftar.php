<div class="main">
    <div class="signup">
        <form method="post" action="<?= base_url('welcome/proses_daftar'); ?>">
            <label for="chk" aria-hidden="true">Daftar Akun</label>
            <center>
                <p class="text-danger mt-2"><?= $this->session->flashdata('pesan'); ?></p> 
            </center>
            <input type="text" name="name" placeholder="Nama Cutomer" required="">
            <input type="email" name="email" placeholder="Email Cutomer" required="">
            <input type="number" name="telp" placeholder="Telp Cutomer" required="">
            <input type="password" name="pswd"  id="myInput" placeholder="Password" required>
            <input type="checkbox" onclick="myFunction()"><span>Show Password</span>
            <button type="submit">Masuk</button>
            <center>
                <p class="">Sudah punya akun ?
                    <a href="<?=base_url('login') ?>" style="text-decoration: none; color: #fff">Login disini</a>
                </p>
            </center>
        </form>
    </div>      
</div>
<script>
    function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>