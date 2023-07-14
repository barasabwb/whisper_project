// misc functions
$(document).ready(function(){
    $('body').fadeIn('fast');

    //updates journal entry times every second
    if(isLoggedIn==true){
        window.setInterval(function(){
            //if there are journal entries update time
            if($('.journal_entry').length){
                $.ajax({
                    data: 'none',
                    type: 'POST',
                    url: url_root + 'main/updateEntryTimers',
                    dataType: "JSON",
                    success: function (data) {
                        $.each(data, function (key, val) {
                            $('#' + key + ' .published_date').html(val);
                        });
                    },
                    error: function (xhr, desc, err) {

                    },
                });
            }
        },1000);
    }
})

//function to handle opening and closing modals
function handle_modal(modal_id){
    if($(modal_id).is(':checked')){
        $(modal_id).prop('checked', false);
    }else{
        $(modal_id).prop('checked', true);
    }
}

//input validation message
function input_message(input, message='error', error=false){
    if(message=='success'){
        input.addClass('input-success');
        input.removeClass('input-error');
    }else{
        if(error!==false){
            input.parent().find('.error_message').html(error);
            input.parent().find('.error_message').fadeIn('fast');
        }
        input.removeClass('input-success');
        input.addClass('input-error');
    }
}

//validate_ email
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;;
    return regex.test(email);
}

//button spinner function
let btn_html;
function add_button_loader(btn, reset=false){
    if(reset===false){
        btn_html = btn.html();
        btn.html('Please Wait &nbsp;<i class="fa-solid fa-spinner fa-spin"></i>');
        btn.prop('disabled', true);
    }else{
        btn.html(btn_html);
        btn_html='';
        btn.prop('disabled', false);
    }

}

//remove validation error
$(document).on('click', '.input_validate', function(){
    $(this).removeClass('input-error');
    $(this).parent().find('.error_message').fadeOut('fast');
});

//theme change (removed)
$(document).on('click', '.page-theme', function(){
    if($('#theme_checkbox').is(':checked')){
        $('.html_body').attr('data-theme', 'dark');
    }else{
        $('.html_body').attr('data-theme', 'light');
    }
});


