if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('cpanel/service-worker.js');
}
$('.close-sidemenu').click(function(){
    $('.sidemenu').toggleClass('sidemenu-open');
})
$('.menu-collapse').click(function(e){
    e.preventDefault();
    $(this).find('.fa-ani').toggleClass('active');
    $(this).next().toggleClass('menu-kecik-active');
})
$('.buang').click(function(e){
    let r = confirm('Adakah anda pasti untuk buang rekod ini?');
    if(!r){
        e.preventDefault();
    }
})

function tapisKeyword(input,tosearch,todissapear){
    $(input).keyup(function(){
        let val = $(this).val();
        $(todissapear).each(function(){
            let ini = $(this).find(tosearch).text();
            if(ini.indexOf(val.toUpperCase())>-1) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        })
    });
}

$('.btn-back').click(function(){
    window.history.back();
})

$('.form-ada-proses').submit(function(){
    $(this).find('[type="submit"]').addClass('disabled');
    $(this).find('[type="submit"]').html('<i class="fa fa-spinner fa-pulse fa-fw"></i> PROSES');
});