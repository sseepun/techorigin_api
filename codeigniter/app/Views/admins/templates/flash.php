<?php if(isset($_SESSION[getenv('app.sessionCookieName').'_FLASH']) && isset($_SESSION[getenv('app.sessionCookieName').'_FLASH_MSG'])){?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(function(){ 'use strict';
            var toastOption = {
                text: "<?= $_SESSION[getenv('app.sessionCookieName').'_FLASH_MSG']; ?>", 
                duration: 3000, 
                newWindow: true, 
                close: true, 
                gravity: 'top', 
                position: 'right', 
                stopOnFocus: true
            };
            toastOption.backgroundColor = '<?php
                if($_SESSION[getenv('app.sessionCookieName').'_FLASH']=='success') echo '#91C714';
                else if($_SESSION[getenv('app.sessionCookieName').'_FLASH']=='info') echo '#1C3FAA';
                else if($_SESSION[getenv('app.sessionCookieName').'_FLASH']=='warning') echo '#F78B00';
                else if($_SESSION[getenv('app.sessionCookieName').'_FLASH']=='danger') echo '#D32929';
            ?>';
            Toastify(toastOption).showToast();
        });
    </script>
<?php unset($_SESSION[getenv('app.sessionCookieName').'_FLASH']); unset($_SESSION[getenv('app.sessionCookieName').'_FLASH_MSG']); }?>
