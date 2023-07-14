<?php if(!checkLogin()){?>
    <section class="navigation_bar_section sticky top-0 z-50">
        <div class="navbar bg-base-100">
          <div class="navbar-start">

            <span class="block md:hidden  hover:scale-105 transition duration-100 ease-in-out cursor-pointer text-xl">
              <img class="inline-block" height="25px" width="25px" src="<?= ROOT?>resources/images/logos/logo2.png" alt="logo">
            <a class="inline-block">
                 <?=APP_NAME?> </a>
                  </span>

          </div>
          <div class="navbar-center">
              <span class=" hidden md:block  hover:scale-105 transition duration-100 ease-in-out cursor-pointer text-xl">
              <img class="inline-block" height="25px" width="25px" src="<?= ROOT?>resources/images/logos/logo2.png" alt="logo">
            <a class="inline-block">
                 <?=APP_NAME?> </a>
                  </span>
          </div>
          <div class="navbar-end space-x-4 md:mr-5 mr-3">

            <button class="btn btn-ghost btn-sm text-xs sign_in_btn">Sign In</button>
            <button class="btn btn-success btn-sm text-xs text-white sign_up_btn">Sign Up</button>
          </div>
        </div>
    </section>
<?php }else {?>
    <section class="navigation_bar_section sticky top-0 z-50 bg-transparent" >
        <div class="navbar ">
            <div class="w-full flex justify-center">
                <div>
                    <ul class="menu menu-horizontal bg-white rounded-box">
                        <li class="my_journals_btn bg-gray-200 rounded-md">
                            <a >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>

                                <span class="hidden md:inline-block">Journal</span>
                            </a>
                        </li>
                        <li class="my_profile_btn">
                            <a>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                               <span class="hidden md:inline-block"><?=$_SESSION['email_address']?></span>
                            </a>
                        </li>
                        <li class="logout_btn ">
                            <a class="hover:bg-red-500 hover:text-white" href="<?=ROOT.'authentication/logout'?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

<?php }?>