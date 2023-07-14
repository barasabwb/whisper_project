
<!--Registration Modal-->
<input type="checkbox" id="login_modal" class="modal-toggle" />
<div class="modal ">
    <div class="modal-box w-11/12 md:w-1/3 max-w-5xl rounded-sm">
        <div class="modal-head flex">
            <h3 class="font-bold text-lg">Sign In</h3>
            <label for="login_modal" class="btn btn-circle btn-outline btn-sm ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
        <div class="modal-body w-full login_form">
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email Address:</span>
                    <span class="label-text-alt error_message text-danger text-red-500 hidden">Error Message</span>
                </label>

                <input type="text" class="input input-bordered w-full email_address input_validate" />

            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Password:</span>
                    <span class="label-text-alt error_message text-red-500 hidden">Error Message</span>

                </label>
                <input type="password" class="input input-bordered w-full password input_validate" />
            </div>
        </div>
        <div class="modal-action">
            <button class="btn btn-success btn-sm finalize_login_btn text-white rounded-sm">Sign In</button>
        </div>
    </div>
</div>

<!--Login Modal-->
<input type="checkbox" id="registration_modal" class="modal-toggle" />
<div class="modal ">
  <div class="modal-box w-11/12 md:w-1/3 max-w-5xl rounded-sm">
    <div class="modal-head flex">
        <h3 class="font-bold text-lg">Sign Up</h3>
        <label for="registration_modal" class="btn btn-circle btn-outline btn-sm ml-auto">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </label>
    </div>
    <div class="modal-body w-full registration_form">
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Email Address:</span>
                <span class="label-text-alt error_message text-red-500 hidden">Error Message</span>

            </label>
            <input type="text" class="input input-bordered w-full email_address input_validate" />
        </div>
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Password:</span>
                <span class="label-text-alt error_message text-red-500 hidden">Error Message</span>
            </label>
            <input type="password" class="input input-bordered w-full password input_validate" />
        </div>
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">Confirm Password:</span>
            </label>
            <input type="password" class="input input-bordered w-full confirm_password input_validate" />
        </div>
    </div>
    <div class="modal-action">
      <button class="btn btn-success btn-sm finalize_sign_up_btn text-white rounded-sm">Sign Up </button>
    </div>
  </div>
</div>

<!--Profile Modal-->
<input type="checkbox" id="user_profile_modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box w-11/12 md:w-1/3 max-w-5xl rounded-sm">
        <div class="modal-head flex">
            <h3 class="font-bold text-lg">Edit Profile</h3>
            <label for="user_profile_modal" class="btn btn-circle btn-outline btn-sm ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
        <div class="modal-body w-full edit_profile_form">
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email Address:</span>
                    <span class="label-text-alt error_message text-red-500 hidden">Error Message</span>

                </label>
                <input type="text" class="input input-bordered w-full email_address input_validate" value="<?=$_SESSION['email_address']?>" />
            </div>
            <div class="mt-4 flex ">
                <button class="ml-auto btn btn-success btn-sm change_email_btn text-white rounded-sm"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    Change Email </button>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Old Password:</span>
                    <span class="label-text-alt error_message text-red-500 hidden">Error Message</span>
                </label>
                <input type="password" class="input input-bordered w-full password input_validate" />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">New Password:</span>
                </label>
                <input type="password" class="input input-bordered w-full new_password input_validate" />
            </div>
            <div class="mt-4 flex ">
                <button class="ml-auto btn btn-success btn-sm change_pwd_btn text-white rounded-sm"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    Change Password
                </button>
            </div>
        </div>
    </div>
</div>

<!--Add Journal Modal-->
<input type="checkbox" id="add_journal_modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box w-11/12 md:w-2/3 max-w-5xl rounded-sm">
        <div class="modal-head flex">
            <h3 class="font-bold text-lg">Add Journal Entry</h3>
            <label for="add_journal_modal" class="btn btn-circle btn-outline btn-sm ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
        <div class="modal-body w-full add_journal_form">
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Entry Title(Maximum of 75 characters):</span>
                    <span class="label-text-alt error_message text-red-500 hidden">Error Message</span>
                </label>
                <input type="text" class="input input-bordered w-full journal_title input_validate" maxlength="75"/>
            </div>
            <div class="form-control w-full mt-2">
                <label class="label">
                    <span class="label-text">Entry Description(Maximum of 500 characters):</span>
                    <span class="label-text-alt error_message text-red-500 hidden ">Error Message</span>
                </label>
                <textarea maxlength="500" class="textarea textarea-bordered h-48 journal_body input_validate" placeholder="Entry Description"></textarea>
            </div>
        </div>
        <div class="modal-action">
            <button class="btn btn-success btn-sm finalize_add_journal_btn text-white rounded-sm">Add Entry</button>
        </div>
    </div>
</div>

<!--View Journal Modal-->
<input type="checkbox" id="view_journal_modal" class="modal-toggle" />
<div class="modal view_journal_modal">
    <div class="modal-box w-11/12 md:w-1/3 max-w-5xl rounded-sm">
        <div class="modal-head flex">
            <h3 class="font-bold text-lg journal_title cursor-pointer">Add Journal Entry</h3>
            <input type="text" class="hidden input input-bordered journal_title_input w-3/4 " maxlength="75"/>
            <label for="view_journal_modal" class="btn btn-circle btn-outline btn-sm ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
        <div class="modal-body w-full edit_profile_form mt-5">
            <small>(Double Click Title or Description to edit)</small>
            <div class="card w-100 bg-base-100 shadow-xl rounded-none">
                <figure><img src="<?= ROOT?>resources/images/stocks/journal_1.jpg" class="w-24 h-24" alt="Shoes" /></figure>
                <div class="card-body ">

                    <p class="description cursor-pointer break-all">If a dog chews shoes whose shoes does he choose?</p>
                    <div class="form-control w-full journal_body_input hidden">
                        <label class="label">
                            <span class="label-text">(Maximum of 500 characters):</span>
                            <span class="label-text-alt error_message text-red-500 hidden ">Error Message</span>
                        </label>
                        <textarea maxlength="500" class="textarea textarea-bordered h-48 journal_body input_validate" placeholder="Entry Description"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Loading Modal-->
<input type="checkbox" id="loading_modal" class="modal-toggle" />
<div class="modal loading_modal">
    <div class="modal-box w-11/12 md:w-1/3 max-w-5xl rounded-sm">
        <div class="modal-head flex">
            <label for="loading_modal" class="btn btn-circle btn-outline btn-sm ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
        <div class="modal-body w-full edit_profile_form mt-5">
            <div class="flex justify-center">
                <span class="loading loading-spinner loading-lg"></span>
            </div>
        </div>
    </div>
</div>