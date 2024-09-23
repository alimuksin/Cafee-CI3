<div class="main">
    <div class="signup">
        <form method="post" action="<?= base_url('login/proses_login'); ?>">
            <label for="chk" aria-hidden="true">Login Admin</label>
            <center>
                <p class="text-danger mt-2"><?= $this->session->flashdata('pesan'); ?></p> 
            </center>
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="pswd" placeholder="Password" required="">
            <button type="submit">Masuk</button>
        </form>
    </div>
</div>