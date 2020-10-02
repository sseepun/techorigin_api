<?php if(isset($_SESSION[getenv('app.sessionCookieName').'FLASH']) && isset($_SESSION[getenv('app.sessionCookieName').'FLASH_MSG'])){?>
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
        <?php if($_SESSION[getenv('app.sessionCookieName').'FLASH']=='success'){?>
            toastr.success('<?= $_SESSION[getenv('app.sessionCookieName').'FLASH_MSG']; ?>');
        <?php }else if($_SESSION[getenv('app.sessionCookieName').'FLASH']=='info'){?>
            toastr.info('<?= $_SESSION[getenv('app.sessionCookieName').'FLASH_MSG']; ?>');
        <?php }else if($_SESSION[getenv('app.sessionCookieName').'FLASH']=='warning'){?>
            toastr.warning('<?= $_SESSION[getenv('app.sessionCookieName').'FLASH_MSG']; ?>');
        <?php }else if($_SESSION[getenv('app.sessionCookieName').'FLASH']=='error'){?>
            toastr.error('<?= $_SESSION[getenv('app.sessionCookieName').'FLASH_MSG']; ?>');
        <?php }?>
    </script>
<?php unset($_SESSION[getenv('app.sessionCookieName').'FLASH']); unset($_SESSION[getenv('app.sessionCookieName').'FLASH_MSG']); }?>
