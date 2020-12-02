
$(document).ready(function(){

    $('#name').blur(function(){
        $(this).removeClass('redBorder');
        $('#nameErr').addClass('d-none');
        $('#nameErr').text('');
        if(!$(this).val()) {
            $(this).addClass('redBorder');
            $('#nameErr').removeClass('d-none');
            $('#nameErr').text('Name is required.');
        }
    });

    $('#phone').blur(function(){
        $pattern = /^([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/i;
        $(this).removeClass('redBorder');
        $('#phoneErr').addClass('d-none');
        $('#phoneErr').text('');
        if(!$(this).val() || !$pattern.test($(this).val())) {
            $(this).addClass('redBorder');
            $('#phoneErr').removeClass('d-none');
            $('#phoneErr').text('Phone number is invalid');
        }
    });

    $('#email').blur(function(){
        $pattern =  /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        $(this).removeClass('redBorder');
        $('#emailErr').addClass('d-none');
        $('#emailErr').text('');
        if(!$(this).val() || !$pattern.test($(this).val())) {
            $(this).addClass('redBorder');
            $('#emailErr').removeClass('d-none');
            $('#emailErr').text('Email is invalid');
        }
    });

    $('#message').blur(function(){
        $(this).removeClass('redBorder');
        $('#messageErr').addClass('d-none');
        $('#messageErr').text('');
        if(!$(this).val() || $(this).val().length <= 25) {
            $(this).addClass('redBorder');
            $('#messageErr').removeClass('d-none');
            $('#messageErr').text('Message should be more than 25 characters.');
        }
    });

})