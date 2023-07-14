//Main functionality

//open registration modal
$(document).on('click', '.sign_up_btn', function(){
    handle_modal('#registration_modal');
});

//create account
$(document).on('click', '.finalize_sign_up_btn', function(){
    let btn = $(this);

    //validation
    if(!isEmail($('.registration_form .email_address').val())){
        input_message($('.registration_form .email_address'),'error','Invalid Email Address');
        return false;
    }

    if($('.registration_form .password').val()<4){
        input_message($('.registration_form .password'),'error','Must be at least 4 characters long');
        return false;
    }

    if($('.registration_form .confirm_password').val()!==$('.registration_form .password').val()){
        input_message($('.registration_form .password'),'error','Passwords do not match');
        input_message($('.registration_form .confirm_password'));
        return false;
    }
    //validation

    //spinner
    add_button_loader(btn);

    //POST REQUEST
    $.ajax({
        data: {
            email_address:$('.registration_form .email_address').val(),
            password:$('.registration_form .password').val()

        },
        type: 'POST',
        url: url_root+'authentication/register_user',
        dataType: "JSON",
        success: function (data) {
            if(data=='registered'){
                $('.registration_form input').each(function(){
                    input_message($(this), 'success');
                });
                window.setTimeout(function(){
                    add_button_loader(btn, true);
                    window.location.href = url_root+'main/dashboard';
                },1000);
            }else{
                add_button_loader(btn, true);
                input_message($('.registration_form .email_address'),'error','Email cannot be used.');
                input_message($('.registration_form .password'));
            }
        },
        error: function (xhr, desc, err) {
            add_button_loader(btn, true);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        },
    });
});

//login modal
$(document).on('click', '.sign_in_btn', function(){
    handle_modal('#login_modal');
});

$(document).on('click', '.finalize_login_btn', function(){
    let btn = $(this);

    //validation
    if(!isEmail($('.login_form .email_address').val())){
        input_message($('.login_form .email_address'),'error','Invalid Email Address');
        return false;
    }

    if($('.login_form .password').val()<4){
        input_message($('.login_form .password'),'error','Must be at least 4 characters.');
        return false;
    }
    //validation

    $('.login_form input').each(function(){
        input_message($(this), 'success');
    });

    add_button_loader(btn);
    $.ajax({
        data: {
            email_address:$('.login_form .email_address').val(),
            password:$('.login_form .password').val()
        },
        type: 'POST',
        url: url_root+'authentication/login_user',
        dataType: "JSON",
        success: function (data) {
            if(data=='logged in'){
                window.setTimeout(function(){
                    add_button_loader(btn, true);
                    window.location.href = url_root+'main/dashboard';
                },1000);
            }else{
                add_button_loader(btn, true);
                input_message($('.login_form .email_address'),'error','Incorrect Credentials.');
                input_message($('.login_form .password'));
            }

        },
        error: function (xhr, desc, err) {
            add_button_loader(btn, true);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        },
    });
});

//edit profile modal
$(document).on('click', '.my_profile_btn', function(){
    handle_modal('#user_profile_modal');
});

//change email
$(document).on('click', '.change_email_btn', function(){
    let btn = $(this);

    if(!isEmail($('.edit_profile_form .email_address').val())){
        input_message($('.edit_profile_form .email_address'), 'error', 'Invalid Email Address');
        return false;
    }

    add_button_loader(btn);
    $.ajax({
        data: {
            email_address:$('.edit_profile_form .email_address').val()
        },
        type: 'POST',
        url: url_root+'authentication/change_details/email',
        dataType: "JSON",
        success: function (data, status) {
            window.setTimeout(function(){
                add_button_loader(btn, true);
                Swal.fire({
                    icon: 'success',
                    title: 'Email Updated',
                    text: 'Email Updated Successfully'
                });
            },1000);
        },
        error: function (xhr, desc, err) {
            add_button_loader(btn, true);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        },
    });
});


//change password
$(document).on('click', '.change_pwd_btn', function(){
    let btn = $(this);

    if($('.edit_profile_form .password').val()<4){
        input_message($('.edit_profile_form .password'),'error','Must be at least 4 characters.');
        return false;
    }

    if($('.edit_profile_form .new_password').val()<4){
        input_message($('.edit_profile_form .new_password'),'error','Must be at least 4 characters.');
        return false;
    }

    add_button_loader(btn);
    $.ajax({
        data: {
            old_password:$('.edit_profile_form .password').val(),
            new_password:$('.edit_profile_form .new_password').val()
        },
        type: 'POST',
        url: url_root+'authentication/change_details/password',
        dataType: "JSON",
        success: function (data) {
            if(data=='changed'){
                window.setTimeout(function(){
                    add_button_loader(btn, true);
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Updated',
                        text: 'Password Updated Successfully'
                    });
                    $('.edit_profile_form .password').val('')
                    $('.edit_profile_form .new_password').val('')
                },1000);
            }else{
                add_button_loader(btn, true);
                input_message($('.edit_profile_form .password'),'error','Incorrect Password');
            }
        },
        error: function (xhr, desc, err) {
            add_button_loader(btn, true);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        },
    });
});

//journal functionalities
//add journal entry modal
$(document).on('click', '.add_journal_btn', function(){
    handle_modal('#add_journal_modal');
});

//submit entry
$(document).on('click', '.finalize_add_journal_btn', function(){
    let btn = $(this);

    if($('.add_journal_form .journal_body').val()<10){
        input_message($('.add_journal_form .journal_body'),'error','Must be at least 10 characters.');
        return false;
    }

    add_button_loader(btn);

    $.ajax({
        data: {
            journal_title:$('.add_journal_form .journal_title').val(),
            journal_body:$('.add_journal_form .journal_body').val()
        },
        type: 'POST',
        url: url_root+'main/add_journal',
        dataType: "JSON",
        success: function (data) {
            window.setTimeout(function(){
                handle_modal('#add_journal_modal');

                //reset inputs
                $('.journal_input').each(function (){
                    $(this).val('');
                });

                //remove empty statement
                if($('.entries_list .empty_list').length){
                    $('.entries_list .empty_list').remove();
                }

                add_button_loader(btn, true);

                Swal.fire({
                    icon: 'success',
                    title: 'New Journal Entry',
                    text: 'Journal Entry Added Successfully',
                    timer: 3000,
                });

                //add new entry without refreshing
                let new_entry = $('.journal_entry').first().clone();
                new_entry.addClass('hidden');
                new_entry.find('.description').html((data.journal_body.length>70?data.journal_body.slice(0, 70)+'....':data.journal_body));
                new_entry.find('.description_mobile').html((data.journal_body.length>70?data.journal_body.slice(0, 40)+'....':data.journal_body));
                new_entry.find('.card-title').html((data.journal_title.length>35?data.journal_title.slice(0, 35)+'....':data.journal_title));
                new_entry.find('.published_date').html(data.published_date);

                new_entry.find('.see_more_btn').prop('id', data.journal_id);
                new_entry.find('.delete_journal_btn').prop('id', data.journal_id);
                new_entry.prop('id', 'journal_'+data.journal_id);

                $('.entries_list').prepend(new_entry);

                window.setTimeout(function(){
                    new_entry.fadeIn('slow');
                },500);

                $('.add_journal_form .journal_title').val('');
                $('.add_journal_form .journal_body').val('');

            },1000);

        },
        error: function (xhr, desc, err) {
            add_button_loader(btn, true);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        },
    });
});

//delete journal
$(document).on('click', '.delete_journal_btn', function(){
    let entry_id = $(this).prop('id');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-5 text-white',
            cancelButton: 'btn bg-red-400 hover:bg-red-500 text-white'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $('#journal_'+entry_id).fadeOut('slow');
            $.ajax({
                data: {entry_id},
                type: 'POST',
                url: url_root+'main/delete_journal',
                dataType: "JSON",
                success: function (data) {
                    window.setTimeout(function (){
                        $('#journal_'+entry_id).remove();
                        if($('.entries_list .journal_entry').length<1){
                            let empty_alert = $('.empty_list').clone();
                            $('.entries_list').html(empty_alert);
                            empty_alert.fadeIn('fast');
                        }
                    },1500);

                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your Entry has been deleted.',
                        'success'
                    );
                },
                error: function (xhr, desc, err) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                },
            });

        }
    });
});

let current_view_id;
//'see more' functionality
$(document).on('click', '.see_more_btn', function(){
    let entry_id = $(this).prop('id');
    current_view_id = 'journal_'+entry_id;
    $('.view_journal_modal').prop('id', entry_id);
    handle_modal('#loading_modal');
    $.ajax({
        data: {entry_id},
        type: 'POST',
        url: url_root+'main/getJournalDetails',
        dataType: "JSON",
        success: function (data) {
            handle_modal('#loading_modal');
            $('.view_journal_modal .journal_title_input').val(data.journal_title);
            $('.view_journal_modal .journal_body').val(data.journal_body);
            $('.view_journal_modal .journal_title').html(data.journal_title);
            $('.view_journal_modal .description').html(data.journal_body);
            handle_modal('#view_journal_modal');
        },
        error: function (xhr, desc, err) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        },
    });
});

//edit journal title
$(document).on('dblclick', '.view_journal_modal .journal_title', function(){
    $(this).addClass('hidden');
    $('.view_journal_modal .journal_title_input').removeClass('hidden').addClass('active_input');
    $('.view_journal_modal .journal_title_input').val($('.view_journal_modal .journal_title').html());
    $('.active_input').keyup( function() {
        let value = ($('.view_journal_modal .journal_title_input').val().length<1?'Untitled':$('.view_journal_modal .journal_title_input').val());
        $('.view_journal_modal .journal_title').html(value);

        $('#'+current_view_id).find('.card-title').html((value.length>35?value.slice(0, 35)+'....':value));
        $.ajax({
            data: {
                journal_title:$('.view_journal_modal .journal_title_input').val(),
                journal_body: $('.view_journal_modal .journal_body').val(),
                journal_id: $('.view_journal_modal').prop('id')
            },
            type: 'POST',
            url: url_root+'main/edit_journal',
            dataType: "JSON",
            success: function (data) {

            },
            error: function (xhr, desc, err) {

            },
        });
    });
});

//edit description title
$(document).on('dblclick', '.view_journal_modal .description', function(){
    $(this).addClass('hidden');
    if($('.view_journal_modal .journal_body').hasClass('input-error')){
        $('.view_journal_modal .journal_body').click();
    }
    $('.view_journal_modal .journal_body').val($('.view_journal_modal .description').html());
    $('.view_journal_modal .journal_body_input').removeClass('hidden').addClass('active_input');

    $('.active_input').keyup( function() {
        if($('.view_journal_modal .journal_body').val().length<10){
            input_message($('.view_journal_modal .journal_body'),'error','Must be at least 10 characters.');
            return false;
        }else{
            if($('.view_journal_modal .journal_body').hasClass('input-error')){
                $('.view_journal_modal .journal_body').click();
            }
        }
        let value = $('.view_journal_modal .journal_body').val();
        $('.view_journal_modal .description').html();
        $('#'+current_view_id).find('.description').html((value.length>70?value.slice(0, 70)+'....':value));
        $('#'+current_view_id).find('.description_mobile').html((value.length>70?value.slice(0, 40)+'....':value));
        $.ajax({
            data: {
                journal_title:$('.view_journal_modal .journal_title_input').val(),
                journal_body: $('.view_journal_modal .journal_body').val(),
                journal_id: $('.view_journal_modal').prop('id')
            },
            type: 'POST',
            url: url_root+'main/edit_journal',
            dataType: "JSON",
            success: function (data) {

            },
            error: function (xhr, desc, err) {

            },
        });
    });
});

//on focus out after edit
$(document).click(function(e) {
    let container = $('.active_input'), exception_1 = $('.view_journal_modal .journal_title'),exception_2 = $('.view_journal_modal .description');
    if (!container.is(e.target) && container.has(e.target).length === 0 && !exception_1.is(e.target) && !exception_2.is(e.target)) {
        container.addClass('hidden').removeClass('active_input');
        $('.view_journal_modal .journal_title').removeClass('hidden');
        $('.view_journal_modal .description').removeClass('hidden');
    }
});

//if enter key is pressed remove current edit
$(document).on('keypress',function(e) {
    if(e.which == 13) {
        if($('.active_input').length){
            $('.active_input').addClass('hidden').removeClass('active_input');
            $('.view_journal_modal .journal_title').removeClass('hidden');
            $('.view_journal_modal .description').removeClass('hidden');
        }
    }
});





