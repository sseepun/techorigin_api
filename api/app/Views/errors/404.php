<div class="container">
    <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
        <div class="-intro-x lg:mr-20">
            <img alt="<?= $appTitle ?>" class="h-48 lg:h-auto" src="<?= $appUrl ?>public/images/error-illustration.svg" />
        </div>
        <div class="text-white mt-10 lg:mt-0">
            <div class="intro-x text-6xl font-medium">404</div>
            <div class="intro-x text-xl lg:text-3xl font-medium">
                ไม่พบหน้าที่คุณค้นหา
            </div>
            <div class="intro-x text-lg mt-3">
                ไม่พบหน้าที่คุณค้นหาในระบบของเรา คุณอาจพิมพ์ที่อยู่ผิด 
                <br> หรือหน้าเว็บไซต์นี้อาจถูกย้ายไป
            </div>
            <a href="<?= $appUrl ?>signin" class="intro-x inline-block button button--lg border border-white dark:border-dark-5 dark:text-gray-300 mt-10">
                กลับสู่หน้าแรก    
            </a>
        </div>
    </div>
</div>
