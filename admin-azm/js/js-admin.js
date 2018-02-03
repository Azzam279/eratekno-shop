$(function () {
	$('.navbar-toggle-sidebar').click(function () {
		$('.navbar-nav').toggleClass('slide-in');
		$('.side-body').toggleClass('body-slide-in');
		$('#search').removeClass('in').addClass('collapse').slideUp(200);
	});

	$('#search-trigger').click(function () {
		$('.navbar-nav').removeClass('slide-in');
		$('.side-body').removeClass('body-slide-in');
		$('.search-input').focus();
	});

	//tampil form input produk ketika diklik
	$("#tampil_form").click(function() {
		$("#input_produk").toggle(1000);
	});

	//tampil form edit profile
	$(".form-azm1").hide();
	$(".ubah_admin1").click(function() {
		$(".form-azm1").slideToggle();
	});
	$(".form-azm2").hide();
	$(".ubah_admin2").click(function() {
		$(".form-azm2").slideToggle();
	});

	//tampil form ganti foto profile admin
	$("#tampil_ganti_foto").hide();
	$("#ganti_foto").click(function() {
		$("#tampil_ganti_foto").fadeToggle();
	});

	//accordion jquery-ui
	$("#accordion").accordion({
		active: true,
		heightStyle: "content",
		collapsible:true
	});

	//Tooltip Bootstrap
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
});

function brands(x){
    $.ajax({
        url      : 'http://localhost/admin-azm/kat-brand.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'b='+x,
        success  : function(jawaban){
            $('#brand').html(jawaban);
        },
    });
    $("#sel_brand").remove();
}

function edit_brands(x,y,z){
    $.ajax({
        url      : 'http://localhost/admin-azm/kat-brand.php',
        type     : 'POST',
        dataType : 'html',
        data     : 'edit_b='+x+'&no='+y,
        success  : function(jawaban){
            $('#e_brand'+z).html(jawaban);
        },
    });
    $("#e_sel_brand"+z).remove();
}