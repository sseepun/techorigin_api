<?php if(isset($_SESSION['FLASH']) && isset($_SESSION['FLASH_MSG'])){?>
    <script>
        toastr.options = {
            'closeButton': false,
            'debug': false,
            'newestOnTop': false,
            'progressBar': true,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'onclick': null,
            'showDuration': '300',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };
        <?php if($_SESSION['FLASH']=='success'){?>
            toastr.success('<?= $_SESSION['FLASH_MSG']; ?>');
        <?php }else if($_SESSION['FLASH']=='info'){?>
            toastr.info('<?= $_SESSION['FLASH_MSG']; ?>');
        <?php }else if($_SESSION['FLASH']=='warning'){?>
            toastr.warning('<?= $_SESSION['FLASH_MSG']; ?>');
        <?php }else if($_SESSION['FLASH']=='error'){?>
            toastr.error('<?= $_SESSION['FLASH_MSG']; ?>');
        <?php }?>
    </script>
<?php unset($_SESSION['FLASH']); unset($_SESSION['FLASH_MSG']); }?>
