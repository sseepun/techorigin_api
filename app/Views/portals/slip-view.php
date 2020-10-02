
<div class="kt-subheader kt-grid__item mb-0">
    <div class="kt-container">
        <div class="table-options mb-2">
            <div class="custom-btns mb-4">
                <a href="/portals/monthly-slips/<?= $slip['year']; ?>/<?= $slip['month']; ?>" class="ml-3 a-link">
                    กลับไปหน้ารวมรายการ
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom CSS */
    .report-wrapper{
        position:relative; padding:2.5rem 3rem; margin:1rem .75rem; 
        -webkit-box-shadow: 0px 0px 10px 0px rgba(88,98,114,0.5);
        -moz-box-shadow: 0px 0px 10px 0px rgba(88,98,114,0.5);
        box-shadow: 0px 0px 10px 0px rgba(88,98,114,0.5);
    }
    .report-wrapper > .img-bg-container{
        position:absolute; top:0; bottom:0; left:0; right:0; opacity:.075;
        display:flex; align-items:center; justify-content:center;
    }
    .report-wrapper > .img-bg-container > img{
        display:block; width:auto; max-width:80%; height:auto; max-height:80%;
    }

    .slip-title{width:100%; display:flex; align-items:center; margin:0 0 1rem 0;}
    .slip-title img{margin:0;}
    .slip-title h3{margin:0;}
    .slip-title h4{margin:0; color:#999;}

    .table-report-info td{border: none; padding:.75rem .75rem .75rem 0; color:#212529;}
    .table-report-info td:last-child{font-weight:bold;}

    .table-report-bill{width:100%;}
    .table-report-bill thead{border: none;}
    .table-report-bill thead th{
        color:#212529; padding: .625rem 0; background-color:#d0d4f5;
    }
    .table-report-bill tbody tr:nth-of-type(even){background-color:rgba(0,0,0,.03);}
    .table-report-bill td{padding: .75rem;}

    .table-report-bill-sum{margin-top:1.5rem; width:100%;}
    .table-report-bill-sum td:first-child{min-width:17rem;}
    .table-report-bill-sum td{ font-size:1.25rem; padding:.75rem; text-align: right; font-weight:bold;}

    .final-price{
        display:flex; flex-wrap:wrap; justify-content:space-between; background-color:#d0d4f5;
        padding: 1.5rem .75rem 1.5rem 5rem; width:100%;
    }
    .final-price > p{font-size: 18px; margin:0;}

    .qr{position:absolute; margin: 0 auto; top:-2rem; left:.75rem; height:calc(100% + 3rem);}

    @media screen and (max-width:991.98px){
        .final-price{padding:1.5rem .75rem 1.5rem 1rem;}
    }
    @media screen and (max-width: 767.98px){
        .qr{position:relative;  top:0;  height:auto;}
    }
    @media screen and (max-width:575.98px){
        .table-report-bill-sum td:first-child{min-width:unset;}
    }
</style>

<div class="report-wrapper">
    <div class="img-bg-container">
        <img src="/assets/logo.png" alt="Slip Logo" />
    </div>

    <div class="row">
        <div class="col-12">
            <div class="kt-header__brand kt-grid__item" id="kt_header_brand">
                <div class="kt-header__brand-logo slip-title">
                    <img alt="Logo" src="/assets/logo.png" class="kt-header__brand-logo-default" />
                    <div class="kt-header__brand-logo-default-txt">
                        <h3 class="text-dark">กระทรวงศึกษาธิการ</h3>
                        <h4>
                            สำนักงานปลัดกระทรวงศึกษาธิการ
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <table class="table-report-info">
                <tbody>
                    <tr>  
                        <td>โอนเงินเข้าวันที่</td>
                        <td>:</td>
                        <td><?= $slip['month']; ?>/<?= $slip['year']; ?></td>
                    </tr>
                    <tr>
                        <td>ชื่อ-สกุล</td>
                        <td>:</td>
                        <td>
                            <?= $slip['prefix']; ?> 
                            <?= $slip['firstname']; ?> 
                            <?= $slip['lastname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>หน่วยงาน</td>
                        <td>:</td>
                        <td>สำนักงานอำนวยการ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table-report-info">
                <tbody>
                    <tr>  
                        <td>ประจำเดือน</td>
                        <td>:</td>
                        <td><?= $slip['month']; ?> ปี พ.ศ. <?= $slip['year']; ?></td>
                    </tr>
                    <tr>
                        <td>ชื่อธนาคาร</td>
                        <td>:</td>
                        <td>ธนาคารกรุงไทย จำกัด(มหาชน) สาขากระทรวงศึกษาธิการ</td>
                    </tr>
                    <tr>
                        <td>เลขที่บัญชี</td>
                        <td>:</td>
                        <td><?= $slip['bank_id']; ?></td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 d-flex flex-wrap align-content-between">
            <table class="table-report-bill text-dark">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center">รายการรับ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<=15; $i++){ if($slip['credit_'.$i] && $slip['credit_amount_'.$i]){?>
                        <tr>
                            <td><?= $i;?>. <?= $slip['credit_'.$i]; ?></td>
                            <td class="text-right">
                                <?= number_format($slip['credit_amount_'.$i], 2); ?> บาท
                            </td>
                        </tr> 
                    <?php }}?>
                </tbody>
            </table>
            <table class="table-report-bill-sum text-dark">
                <td>รวมรับทั้งหมด</td>
                <td><?= number_format($slip['total_credit'], 2); ?> บาท</td>
            </table>
        </div>
        <div class="col-md-6 d-flex flex-wrap align-content-between">
            <table class="table-report-bill text-dark">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center">รายการหัก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1; $i<=15; $i++){ if($slip['debit_'.$i] && $slip['debit_amount_'.$i]){?>
                        <tr>
                            <td><?= $i;?>. <?= $slip['debit_'.$i]; ?></td>
                            <td class="text-right">
                                <?= number_format($slip['debit_amount_'.$i], 2); ?> บาท
                            </td>
                        </tr> 
                    <?php }}?>
                </tbody>
            </table>
            <table class="table-report-bill-sum text-dark">
                <td>รวมรับทั้งหมด</td>
                <td><?= number_format($slip['total_debit'], 2); ?> บาท</td>
            </table>
        </div>
    </div>

    <div class="row mt-5 mb-3 position-relative">
        <div class="col-md-6 d-flex justify-content-end  align-items-center">
            <h5 class="mb-0 text-dark">
                รายได้สุทธิ
            </h5>
        </div>
        <div class="col-md-6">
            <div class="final-price text-dark">
                <!-- <p class="price-text kt-font-bold">( สามหมื่นสามพันบาทถ้วน )</p> -->
                <p class="price-num kt-font-boldest text-right" style="width:100%;">
                    <?= number_format($slip['total'], 2); ?> บาท บาท
                </p>
            </div>
        </div>
        <img class="qr" src="/assets/QR_Default.png" alt="QR_CODE">
    </div>
</div>
