
<?php if(@$_SESSION['sukses']){ ?>
<script>
    swal("Sukses", "<?= $this->session->flashdata('sukses'); ?>", {
        icon : "success",
        buttons: {                  
            confirm: {
                className : 'btn btn-success'
            }
        },
        timer: 3000,                                
        showConfirmButton: false
    });
</script>
<!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
<?php unset($_SESSION['sukses']); } ?>
<?php if(@$_SESSION['error']){ ?>
<script>
    swal("gagal", "<?= $this->session->flashdata('error'); ?>", {
        icon : "error",
        buttons: {                  
            confirm: {
                className : 'btn btn-danger'
            }
        },
        timer: 3000,                                
        showConfirmButton: false
    });
    
</script>
<?php unset($_SESSION['error']); } ?>


<!-- HAPUS ALERT -->
<script>
    $('.alert_notif').on('click',function(){
        var getLink = $(this).attr('href');
        swal({
            title: "Yakin hapus data?",
            text: "Kamu tidak akan melihat data ini lagi !",
            icon: 'warning',
            buttons:{
                cancel: {
                    visible: true,
                    text : 'No, cancel!',
                    className: 'btn btn-danger'
                },                  
                confirm: {
                    text : 'Yes, delete it!',
                    className : 'btn btn-success'
                }
            }
        }).then(result => {
            if(result.isConfirmed){
                window.location.href = getLink
            }
        })
        return false;
    });
</script>
