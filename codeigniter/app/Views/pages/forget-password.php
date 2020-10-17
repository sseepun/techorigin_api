
<div class="container sm:px-10">
	<div class="block xl:grid grid-cols-2 gap-4">
	
		<div class="hidden xl:flex flex-col min-h-screen">
			<a href="<?= $appUrl ?>signin" class="-intro-x flex items-center pt-5">
				<img alt="Midone Tailwind HTML Admin Template" class="w-6" src="<?= $appUrl; ?>public/logo_white.png">
				<span class="text-white text-lg ml-3">
					<?= $appTitle ?>
				</span>
			</a>
			<div class="my-auto">
				<img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="<?= $appUrl; ?>public/images/illustration.svg">
				<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
					ลืมรหัสผ่าน
				</div>
				<div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">
					ระบบการจัดการข้อมูลลูกค้าครบวงจร
				</div>
			</div>
		</div>
		
		<div class="h-screen xl:h-auto flex py-5 xl:py-0 xl:my-0">
			<div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
				<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
					ลืมรหัสผ่าน
				</h2>
				<div class="intro-x mt-2 text-gray-500 text-center xl:text-left">
					กรอกข้อมูลเพื่อทำการตั้งรหัสผ่านใหม่
				</div>
				<form class="kt-login-v1__form kt-form" action="" method="POST" autocomplete="off">
					<?= csrf_field() ?>

					<div class="intro-x mt-8">
						<input type="text" name="username" class="intro-x login__input input input--lg border border-gray-300 block" 
						placeholder="ชื่อผู้ใช้ / อีเมล์" value="<?= set_value('username') ?>" autocomplete="off" required />
						<input type="hidden" name="killbot" />
					</div>
					<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
						<button type="submit" class="inline-block button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">
							ตั้งรหัสผ่านใหม่
						</button>
						<a class="inline-block button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mt-3 xl:mt-0 align-top" 
						href="<?= $appUrl ?>signin">
							เข้าสู่ระบบ
						</a>
					</div>
					<?php if(isset($validation)){?>
						<div class="intro-x rounded-md flex items-center px-5 py-4 mt-5 bg-theme-6 text-white alert-card">
							<i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>
							<div class="mr-2">
								<?= $validation->listErrors() ?>
							</div>
							<i data-feather="x" class="w-4 h-4 ml-auto"></i>
						</div>
					<?php }?>
				</form>
			</div>
		</div>
		
	</div>
</div>
