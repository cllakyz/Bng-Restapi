$(document).ready(function () {
    $('dd').hide();
    $(document).on('click','dt',function () {
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).next().removeClass('active');
            $(this).next().slideUp(300);
            return false;
        }else{
            $('dd').slideUp(300);
            $('dt').not($(this)).removeClass('active');
            $('dd').not($(this).next()).removeClass('active');
            $(this).next().slideDown(300);
            $(this).addClass('active');
            $(this).next().addClass('active');
        }

    });
});