<style>

    /* Custom CSS */
    .report-wrapper{
        padding: 1.5rem 2rem; margin:1rem .75rem; 
        -webkit-box-shadow: 0px 0px 10px 0px rgba(88,98,114,0.5);
        -moz-box-shadow: 0px 0px 10px 0px rgba(88,98,114,0.5);
        box-shadow: 0px 0px 10px 0px rgba(88,98,114,0.5);
    }
    .table-report-info td{border: none; padding:.75rem .75rem .75rem 0; color:#212529;}
    .table-report-info td:last-child{font-weight:bold;}


    .table-report-bill {width:100%;}
    .table-report-bill thead {border: none;}
    .table-report-bill thead th { color:#212529; padding: .625rem 0; background-color:#d0d4f5; }
    .table-report-bill tbody tr:nth-of-type(even){background-color:#f7f8fa;}
    .table-report-bill td {padding: .75rem;}


    .table-report-bill-sum{margin-top:1.5rem; width:100%;}
    .table-report-bill-sum td:first-child{min-width:17rem;}
    .table-report-bill-sum td{ font-size:1.25rem; padding:.75rem; text-align: right; font-weight:bold;}


    .final-price {display:flex; flex-wrap:wrap; justify-content:space-between; background-color:#d0d4f5; padding: 1.5rem .75rem 1.5rem 5rem; width:100%; }
    .final-price > p{font-size: 18px; margin:0;}

    .qr {position:absolute; margin: 0 auto; top:-2rem; left:.75rem; height:calc(100% + 3rem);}
    @media screen and (max-width:991.98px){
        .final-price {padding:1.5rem .75rem 1.5rem 1rem;}
    }
    @media screen and (max-width: 767.98px){
        .qr{position:relative;  top:0;  height:auto;}
    }
    @media screen and (max-width:575.98px){
        .table-report-bill-sum td:first-child{min-width:unset;}
    }
</style>

<div class="report-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                <div class="kt-header__brand-logo">
                    <img alt="Logo" src="/assets/logo.png" class="kt-header__brand-logo-default" />
                    <div class="kt-header__brand-logo-default-txt">
                        <h3 class="text-dark">กระทรวงศึกษาธิการ</h3>
                        <h4 class="kt-font-metal">สำนักงานปลัดกระทรวงศึกษาธิการ</h4>
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
                        <td>26/05/2563</td>
                    </tr>
                    <tr>
                        <td>ชื่อ-สกุล</td>
                        <td>:</td>
                        <td>สินใจ มากมายทรัพย์</td>
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
                        <td>พฤษภาคม ปี พ.ศ. 2563</td>
                    </tr>
                    <tr>
                        <td>ชื่อธนาคาร</td>
                        <td>:</td>
                        <td>ธนาคารกรุงไทย จำกัด(มหาชน) สาขากระทรวงศึกษาธิการ</td>
                    </tr>
                    <tr>
                        <td>เลขที่บัญชี</td>
                        <td>:</td>
                        <td>012-3-45678-9</td>
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
                    <?php for($i=1; $i < 9; $i++){?>
                        <tr>
                            <td><?= $i.'.';?> เงินเดือน</td>
                            <td class="text-right">34,000 บาท</td>
                        </tr> 
                    <?php }?>
                </tbody>
            </table>

            <table class="table-report-bill-sum text-dark">
                <td>รวมรับทั้งหมด</td>
                <td>43,000.00 บาท</td>
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
                    <?php for($i=1; $i < 13; $i++){?>
                        <tr>
                            <td><?= $i.'.';?> ภาษี</td>
                            <td class="text-right">34,000 บาท</td>
                        </tr> 
                    <?php }?>
                </tbody>
            </table>


            <table class="table-report-bill-sum text-dark">
                <td>รวมรับทั้งหมด</td>
                <td>100,000.00 บาท</td>
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
                <p class="price-text kt-font-bold">( สามหมื่นสามพันบาทถ้วน )</p>
                <p class="price-num kt-font-boldest">33,000.00 บาท</p>
            </div>
        </div>
        <img class="qr" src="/assets/QR_Default.png" alt="QR_CODE">
    </div>


</div>

