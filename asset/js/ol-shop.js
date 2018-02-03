//root domain website
var host = $("#host").val();

//Efek Loading halaman
$(window).load(function() { // makes sure the whole site is loaded
    $("#status").fadeOut(); // will first fade out the loading animation
    $("#preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
})

//Slider HomePage BEGIN
$(document).ready(function() {
    $('#myCarousel').carousel({
        interval: 4000
    });
    
    var clickEvent = false;
    $('#myCarousel').on('click', '.nav1 a', function() {
            clickEvent = true;
            $('.nav1 li').removeClass('active');
            $(this).parent().addClass('active');        
    }).on('slid.bs.carousel', function(e) {
        if(!clickEvent) {
            var count = $('.nav1').children("li").length - 1;
            var current = $('.nav1 li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if(count == id) {
                $('.nav1 li').first().addClass('active');    
            }
        }
        clickEvent = false;
    });
});
//Slide HomePage END

$(document).ready(function() {
    //Initiat WOW JS
    new WOW().init();

    // Show/Hide Sticky "Go to top" button
    $(window).scroll(function(){
        if($(this).scrollTop()>200){
            $(".gotop").fadeIn(1000);
        }
        else{
            $(".gotop").fadeOut(1000);
        }
    });
    // Scroll Page to Top when clicked on "go to top" button
    $(".gotop").click(function(event){
        event.preventDefault();

        $.scrollTo('#gototop', 1500, {
            easing: 'easeOutCubic'
        });
    });

    // Menentukan elemen yang dijadikan sticky yaitu .nav
    var stickyNavTop = $('#nav').offset().top; 
    var stickyNav = function(){
        var scrollTop = $(window).scrollTop();  
        // Kondisi jika discroll maka menu akan selalu diatas, dan sebaliknya        
        if (scrollTop > stickyNavTop) { 
            $('.menu-utama').removeClass("nav-relative");
            $('.menu-utama').addClass("nav-fixed");
            $('#brand-img').removeClass("brand-img-lg");
            $('#brand-img').addClass("brand-img");
        } else {
            $('.menu-utama').removeClass("nav-fixed");
            $('.menu-utama').addClass("nav-relative");
            $('#brand-img').removeClass("brand-img");
            $('#brand-img').addClass("brand-img-lg");
        }
    };
    // Jalankan fungsi
    stickyNav();
    $(window).scroll(function() {
        stickyNav();
    });

    //Toggle kategori fixed
    $("#slide-kat").hide();
    $("#btn-kat").click(function() {
        $(".list-group-fixed").show();
        $("#slide-kat").slideToggle();
    });

    $(window).scroll(function(){
        if($(this).scrollTop()>15){
            $("#breadcrumbz").fadeOut(400);
        }
        else{
            $("#breadcrumbz").slideDown(400);
        }
    });

    //Carousel-control
    $("#slideHome").mouseenter(function() {
        $(this).children(".carousel-control").fadeIn();
    });
    $("#slideHome").mouseleave(function() {
        $(this).children(".carousel-control").fadeOut();
    });

    //Animasi Thumbnail
	$(".thumbnail").mouseenter(function(){
		$(this).children(".zoomTool").fadeIn();
	});
	$(".thumbnail").mouseleave(function(){
		$(this).children(".zoomTool").fadeOut();
	});

    //Tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    //#main-slider
    $(function(){
        $('#slideHome.carousel').carousel({
            interval: 4000
        });
    });

    //#newProductCar
    $('#newProductCar').carousel({
        interval: 2500
    });
    //#popular_produk
    $('#popular_produk.carousel').carousel({
        interval: 3000
    });
    //#best_produk
    $('#best_produk.carousel').carousel({
        interval: 3500
    });

    //menu-dropdown
    $("#menu > ul > li > .dropdown-toggle").mouseenter(function() {
        $(this).children("i").remove();
        $(this).append('<i class="fa fa-angle-up"></i>');
    });

    $("#menu > ul > li > .dropdown-toggle").mouseleave(function() {
        $(this).children("i").remove();
        $(this).append('<i class="fa fa-angle-down"></i>');
    });

    //product-box-button-hover
    $(".product-box-new").children(".btn").css("display","none");
    $(".product-box-new").children("h4").css("padding-bottom","34px");

    $(".product-box-new").mouseenter(function() {
        $(this).children(".btn").css("display","block");
        $(this).children("h4").css("padding-bottom","0px");
    });
    $(".product-box-new").mouseleave(function() {
        $(this).children(".btn").css("display","none");
        $(this).children("h4").css("padding-bottom","34px");
    });

    $(".product-box-new tr td").children(".btn").css("display","none");
    $(".product-box-new tr td").mouseenter(function() {
        //alert(children(".product-box-new"));
        $(this).children(".btn").css("display","block");
    });
    $(".product-box-new tr td").mouseleave(function() {
        $(this).children(".btn").css("display","none");
    });

    //Sidebar customer active
    $(".nav-client a").click(function() {
        $('.nav-client li').removeClass('active');
        $(this).parent().addClass('active'); 
    });

    //zoom image detail-produk ketika di hover
    //initiate the plugin and pass the id of the div containing gallery images 
    $("#zoom_01").elevateZoom({
        constrainType:"height", 
        constrainSize:400, 
        zoomType: "inner", 
        containLensZoom: true, 
        gallery:'gallery_01', 
        cursor: 'crosshair',
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750, 
        galleryActiveClass: "active"});
    //pass the images to Fancybox 
    $("#zoom_01").bind("click", function(e) { var ez = $('#zoom_01').data('elevateZoom');  $.fancybox(ez.getGalleryList()); return false; });

    //efek slide pada menu kategori
    $('#slide-submenu').on('click',function() {                 
        $(this).closest('.list-group').fadeOut('slide',function(){
            $('.mini-submenu').fadeIn();    
        });
        
      });

    $('.mini-submenu').on('click',function(){       
        $(this).next('.list-group').toggle('slide');
        $('.mini-submenu').hide();
    });

    //fungsi popover bootstrap
    $('[data-toggle="popover"]').popover();

     //Tampilkan kotak dialog saat .muncul diklik
     $('.muncul').click(function() {
          $('#dialog-box').fadeIn();
          $('#dialog-overlay').fadeTo("normal", 0.4);
     });
     //Tutup kotak dialog saat .tutup diklik
     $('.tutup').click(function() {
          $('#dialog-box').fadeOut();
          $('#dialog-overlay').hide();
     });
     //Tutup kotak dialog saat #dialog-overlay diklik
     $('#dialog-overlay').click(function() {
          $('#dialog-box').fadeOut();
          $('#dialog-overlay').hide();
     });

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $(function() {
        $('a.page-scroll').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });

});

//Hanya boleh Diisi dengan huruf
function isNumberKeyHuruf(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if ((charCode < 65) && (charCode != 32))
        return false;        
     return true;
  }

//Hanya boleh Diisi dengan angka
function isNumberKeyAngka(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if ((charCode >= 48) && (charCode <= 57))
        return true;        
     return false;
  }

function test(val) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState==4 &&xmlhttp.status==200) {
            document.getElementById("x").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","sorting.php?x="+val,true);
    xmlhttp.send();
}

//hitung subtotal
function hitung(h1,h2,h3){
    var a = $('#'+h1+'').val();
    $.ajax({
        url      : host+'/produk/hitung-subtotal.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'content='+a+'&content2='+h2,
        success  : function(jawaban){
            $('#hasil'+h3).html(jawaban);
        },
    });
}

//insert produk ke troli
function addProduk(p1,p2,p3,p4,p5){
    $.ajax({
        url      : host+'/produk/add-to-troly.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'isi1='+p1+'&isi2='+p2+'&isi3='+p3+'&isi4='+p4+'&isi5='+p5,
        success  : function(jawaban){
            $('#error').html(jawaban);
        },
    });
}

//menambahkan produk ke wishlist
function addWishlist(nmr){
    $.ajax({
        url      : host+'/produk/add-wishlist-ajax.php',
        type     : 'POST',
        dataType : 'php',
        data     : 'wish='+nmr,
        success  : function(jawaban){
            $('#error').html(jawaban);
        },
    });
}

//fungsi sorting produk
function sorting(val_select) {
    window.location = val_select;
}

//fungsi paging select
function paging(page_select) {
    window.location = page_select;
}
