<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= $title; ?></title>
    <!-- MDB icon -->
    <link rel="icon" href="<?=base_url('dist/') ?>img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link href="<?=base_url('dist/') ?>/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- Google Fonts Roboto -->
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Carter+One&family=Pacifico&family=Roboto+Condensed:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link rel="stylesheet" href="<?=base_url('dist/') ?>css/mdb.min.css" />
    <!-- PRISM -->
    <link rel="stylesheet" href="<?=base_url('dist/') ?>dev/css/new-prism.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('dist/app.css') ?>">
    <script type="text/javascript" src="<?=base_url('dist/jquery-3.min.js') ?>"></script>
    <link href="<?=base_url('dist/') ?>/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('dist/') ?>/plugins/sweetalert2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="<?=base_url('dist/') ?>/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    
    <script src="<?=base_url('dist') ?>/jquery-3.min.js"></script>
    <style>
        .icon-navbard:hover{
            color: var(--warna-hover);
        }
        .btn-outline-hover{
            color: #fff;
            border-color: #6D3202;
            hover-color: #fff;
            hover-bg: #6D3202;
            hover-border-color: #0dcaf0;
            focus-shadow-rgb: 13,202,240;
            active-color: #6D3202;
            active-bg: #0dcaf0;
            active-border-color: #0dcaf0;
            active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            disabled-color: #0dcaf0;
            disabled-bg: transparent;
            disabled-border-color: #0dcaf0;
        }

        .btn-outline-hover:hover{
            color: #fff;
            border-color: #fff;
            background-color: #C45E0B;
        }
    </style>
	<script>
		function loadJumlah(){
			$("#product_detail_cart_count").load("<?= base_url('pesan/product_detail_cart_count') ?>");
		}
	</script>
  </head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow bg-utama">
        <div class="container-fluid">

            <a class="navbar-brand d-sm-block d-md-block" href="<?=base_url('') ?>">
                <?= $name_kon ?>
            </a>
            <div class="float-end">
                <!-- <a href="<?= base_url('cekout') ?>" class="mr-2 d-none d-sm-none d-md-block d-lg-none icon-navbard"><i class="fa fa-shopping-cart"></i></a> -->
                <button
                    class="navbar-toggler pe-1"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent1"
                    aria-controls="navbarSupportedContent1"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon d-flex justify-content-end align-items-center">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="<?=base_url('') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('') ?>pesan">Pesan Menu</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('') ?>reservasi">Cek Meja</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('') ?>cara-pesan">Cara </a>
                    </li>
                    <?php if ($this->session->userdata('is_login') == true) {?>
                        <li class="nav-item">
                          <a class="nav-link" href="<?=base_url('') ?>welcome/logout">Logout</a>
                        </li>
                    <?php } ?>
                    <!-- d-none d-sm-none d-md-block d-lg-non -->
                </ul>
                <div class="mt-2 mb-2 d-none d-sm-none d-md-block d-lg-none">
                    <a href="<?= base_url('cekout') ?>" class="btn btn-hover"><i class="fa fa-shopping-cart"></i></a>
                    <a href="<?= base_url('login') ?>" class="btn btn-hover"><i class="fa fa-user"></i></a>
                </div>
            </div>
            
            <a href="<?=base_url('') ?>cekout" id="cart_count" class="d-none d-lg-block btn btn-hover" style="margin-right: 10px;">
                <i class="fa fa-shopping-cart"></i>
                <span class="count" id="product_detail_cart_count"> 
                  	<!-- <?php
						if (!empty($this->cart->contents())) {
							echo number_format($this->cart->total_items());
						} else {
							print 0;
						}
					?> -->
                </span>
            </a>
            <?php if ($this->session->userdata('is_login') == true) {
               echo '<a href="'.base_url('customer/akun').'" class="d-none d-lg-block btn btn-outline-hover ml-2">Profile</a>';
            }else{
                echo '<a href="'.base_url('login').'" class="d-none d-lg-block btn btn-outline-hover ml-2">Login</a>';
            }?>
            
        </div>
    </nav>

    <!-- Bottom Navbar -->
    <nav class="navbar navbar-dark bg-hover navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item">
                <a href="<?= base_url('') ?>" class="nav-link">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('pesan') ?>" class="nav-link">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16"  fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M.5 6a.5.5 0 0 0-.488.608l1.652 7.434A2.5 2.5 0 0 0 4.104 16h5.792a2.5 2.5 0 0 0 2.44-1.958l.131-.59a3 3 0 0 0 1.3-5.854l.221-.99A.5.5 0 0 0 13.5 6H.5ZM13 12.5a2.01 2.01 0 0 1-.316-.025l.867-3.898A2.001 2.001 0 0 1 13 12.5ZM2.64 13.825 1.123 7h11.754l-1.517 6.825A1.5 1.5 0 0 1 9.896 15H4.104a1.5 1.5 0 0 1-1.464-1.175Z"/>
                        <path d="m4.4.8-.003.004-.014.019a4.167 4.167 0 0 0-.204.31 2.327 2.327 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.593.593 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3.31 3.31 0 0 1-.202.388 5.444 5.444 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 3.6 4.2l.003-.004.014-.019a4.149 4.149 0 0 0 .204-.31 2.06 2.06 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.593.593 0 0 0-.09-.252A4.334 4.334 0 0 0 3.6 2.8l-.01-.012a5.099 5.099 0 0 1-.37-.543A1.53 1.53 0 0 1 3 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a5.446 5.446 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 4.4.8Zm3 0-.003.004-.014.019a4.167 4.167 0 0 0-.204.31 2.327 2.327 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.593.593 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3.31 3.31 0 0 1-.202.388 5.444 5.444 0 0 1-.253.382l-.018.025-.005.008-.002.002A.5.5 0 0 1 6.6 4.2l.003-.004.014-.019a4.149 4.149 0 0 0 .204-.31 2.06 2.06 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.593.593 0 0 0-.09-.252A4.334 4.334 0 0 0 6.6 2.8l-.01-.012a5.099 5.099 0 0 1-.37-.543A1.53 1.53 0 0 1 6 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a5.446 5.446 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 7.4.8Zm3 0-.003.004-.014.019a4.077 4.077 0 0 0-.204.31 2.337 2.337 0 0 0-.141.267c-.026.06-.034.092-.037.103v.004a.593.593 0 0 0 .091.248c.075.133.178.272.308.445l.01.012c.118.158.26.347.37.543.112.2.22.455.22.745 0 .188-.065.368-.119.494a3.198 3.198 0 0 1-.202.388 5.385 5.385 0 0 1-.252.382l-.019.025-.005.008-.002.002A.5.5 0 0 1 9.6 4.2l.003-.004.014-.019a4.149 4.149 0 0 0 .204-.31 2.06 2.06 0 0 0 .141-.267c.026-.06.034-.092.037-.103a.593.593 0 0 0-.09-.252A4.334 4.334 0 0 0 9.6 2.8l-.01-.012a5.099 5.099 0 0 1-.37-.543A1.53 1.53 0 0 1 9 1.5c0-.188.065-.368.119-.494.059-.138.134-.274.202-.388a5.446 5.446 0 0 1 .253-.382l.025-.035A.5.5 0 0 1 10.4.8Z"/>

                    </svg>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= base_url('cekout') ?>" class="nav-link">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16"  fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg>
                    <span class="count" id="product_detail_cart_count"> 
                      0
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <?php if ($this->session->userdata('is_login') == true) {
                   echo '<a href="'.base_url('customer/akun').'" class="nav-link">';
                }else{
                    echo '<a href="'.base_url('login').'" class="nav-link">';
                }?>
                
                  <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  </svg>
                </a>
          </li>
        </ul>
    </nav>

    <main class="home">
        <?= $contents; ?>
    </main>

    <!-- MDB -->
    <script type="text/javascript" src="<?=base_url('dist/') ?>js/mdb.min.js"></script>
    <!-- PRISM -->
    <script type="text/javascript" src="<?=base_url('dist/') ?>dev/js/new-prism.js"></script>
    <!-- MDB SNIPPET -->
    <script type="text/javascript" src="<?=base_url('dist/') ?>dev/js/dist/mdbsnippet.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript">
		$(document).ready(function(){
			loadJumlah();
		});
	</script>
  </body>
</html>



