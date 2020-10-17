<div class="intro-x dropdown mr-auto sm:mr-6">
    <div class="dropdown-toggle notification notification--bullet cursor-pointer">
        <i data-feather="bell" class="notification__icon dark:text-gray-300"></i>
    </div>
    <div class="notification-content pt-2 dropdown-box">
        <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
            <div class="notification-content__title">Notifications</div>
            <?php for($i=0; $i<5; $i++){?>
                <div class="cursor-pointer relative flex items-center <?php if($i>0)echo 'mt-5'; ?>">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?= $appUrl ?>public/images/profile-11.jpg">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Tom Cruise</a> 
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">03:20 PM</div>
                        </div>
                        <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div>
