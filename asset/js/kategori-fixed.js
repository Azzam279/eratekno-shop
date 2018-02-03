$(document).ready(function() {
    // Menentukan elemen yang dijadikan sticky yaitu #kategory
    var KatNavTop = $('#kategory').offset().top; 
    var KatNav = function(){
        var scrollTop2 = $(window).scrollTop();  
        // Kondisi jika discroll maka menu akan selalu diatas, dan sebaliknya 
        if (scrollTop2 > KatNavTop) { 
            $('#kategory').css({ 'position': 'fixed', 'top':3, 'z-index':9999, 'left':5, 'width':'15%', 'transition': 'all 0.2s linear', 'margin':0 });
        } else {
            $('#kategory').css({ 'position': 'relative', 'width':'99.5%', 'top':0, 'margin-bottom':'5px', 'transition': 'all 0.2s linear', 'z-index':'1' });
        }       
    };
    // Jalankan fungsi
    KatNav();
    $(window).scroll(function() {
        KatNav();
    });
});
    