<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Data Login</h5>
                <table class="table">
                    <tr>
                        <td>Nama Pengguna</td>
                        <td width="1px">:</td>
                        <td><?= $this->session->userdata('name_user') ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td width="1px">:</td>
                        <td><?= $this->session->userdata('email_user') ?></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td width="1px">:</td>
                        <td><?php if ($this->session->userdata('role_user') == 1) {
                            echo "Admin";
                        }else{
                            echo "Kasir";
                        } ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td width="1px">:</td>
                        <td><?php if ($this->session->userdata('is_admin') == 1) {
                            echo "<span class='text-success'>Login</span>";
                        }else{
                            echo "Tidak Ada";
                        } ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Customer</p>
                                    <h4 class="card-title">
                                        <?= $this->db->get('customer')->num_rows(); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-coins text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Total Transaksi</p>
                                    <h4 class="card-title">
                                        <?= $this->db->get('transaksi')->num_rows(); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-star"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Minuman</p>
                                    <h4 class="card-title">
                                        <?= $this->db->get_where('produk', array('jenis_produk' => 'minuman'))->num_rows(); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-warning card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-star"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Makanan</p>
                                    <h4 class="card-title">
                                        <?= $this->db->get_where('produk', array('jenis_produk' => 'makanan'))->num_rows(); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
