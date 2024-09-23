<div class="main">
    <div class="signup">
        <form method="post" action="<?= base_url('welcome/proses_login'); ?>">
            <label for="chk" aria-hidden="true">Login Akun</label>
            <center>
                <p class="text-danger mt-2"><?= $this->session->flashdata('pesan'); ?></p> 
            </center>
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="pswd"  id="myInput" placeholder="Password" required>
            <input type="checkbox" onclick="myFunction()"><span>Show Password</span>
            <button type="submit">Masuk</button>
            <center>
                <p class="">Belum punya akun ?
                    <a href="<?=base_url('daftar') ?>" style="text-decoration: none; color: #fff">Daftar Dulu</a> <br>
                    <a href="<?=base_url('lupa-password') ?>" style="text-decoration: none; color: #291301;">Forgot Password</a>
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
