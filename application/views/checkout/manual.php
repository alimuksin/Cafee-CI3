<style type="text/css">
    .invoice{
        background-color: #fff;
        min-height: 100px;
    }

    label{
        color: #fff;
    }

    .radio-item [type="radio"] {
        display: none;
    }
    .radio-item + .radio-item {
        margin-top: 15px;
    }
    .radio-item label {
        padding: 20px 60px;
        background: var(--warna-utama);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 400;
        width: 100%;
        white-space: nowrap;
        position: relative;
        transition: 0.4s ease-in-out 0s;
    }
    .radio-item label:after,
    .radio-item label:before {
        content: "";
        position: absolute;
        border-radius: 50%;
    }
    .radio-item label:after {
        height: 19px;
        width: 19px;
        border: 2px solid #fff;
        left: 19px;
        top: calc(50% - 12px);
    }
    .radio-item label:before {
        background: #fff;
        height: 20px;
        width: 20px;
        left: 21px;
        top: calc(50%-5px);
        transform: scale(5);
        opacity: 0;
        visibility: hidden;
        transition: 0.4s ease-in-out 0s;
    }
    .radio-item [type="radio"]:checked ~ label {
        border-color: #FFF;
    }
    .radio-item [type="radio"]:checked ~ label::before {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }


</style>
<div class="container mt-5">
    <div class="home-kedua mb-4 row">
        <h5 class="home-judul text-center fw-bold">PEMBAYARAN MANUAL
        </h5>

        <div class="row justify-content-center m-0">
            <div class="col-md-6">
                <div class="card p-0">
                    <div class="card-body p-0">
                        
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                            <div class="invoice">
                                <div class="text-center p-2">
                                    Silahkan datang ke kasir untuk melakukan pembayaran
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("div.desc").hide();
        $("input[name$='cars']").click(function() {
            var test = $(this).val();
            $("div.desc").hide();
            $("#" + test).show();
        });
    });
</script>