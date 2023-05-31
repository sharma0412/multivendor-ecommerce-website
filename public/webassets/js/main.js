// header search bar
$("#search-toggle").click(function(){
  $(".searchbar-block").css('display', 'flex');
  $(document).mouseup(function(e) 
  {
    var container = $(".search-input");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $(".searchbar-block").hide();
    }
   });
});
//========home-banner======
$('.select-banner-slider').owlCarousel({
    center: true,
    items:3,
    navs:true,
    loop:true,
    margin:15
});
// $('.select-banner-slider').on('changed.owl.carousel', function(e) {
//     var hi = $('.owl-item.center').children('.banner-option').attr('src');
//     console.log(hi);
//     $('#banner-img').attr('src',hi);
// });

var centerimg = $('.owl-item.active.center').children('.banner-option').attr('src');
$('#banner-img').attr('src' , centerimg);

$('.select-banner').click(function(){
    var clickbanner = $(this).children('.banner-option').attr('src');
    console.log(clickbanner);
     $('#banner-img').attr('src' , clickbanner);
 });

//===================
$('.slider-rec').owlCarousel({
    loop:true,
    margin:24,
    autoplay:true,
    responsiveClass:true,
    nav:false,
    autoplayTimeout:3000,
    responsive:{
        0:{
            items:1

        },
        400:{
            items:2

        },
        780:{
            items:3

        },
        1000:{
            items:5
        }
    }
})
/**slect
 * 
 */
 $(document).ready(function() {
    $('.nice-select').niceSelect();
  });
// filter sidebar
if ( $(window).width() < 992) {
    $('#show-filters-btn').click(function(){
      $('.side-filter-bar').css('display','block');
    });
    $('.close-filter-btn').click(function(){
      $('.side-filter-bar').css('display','none');
    });
}
// $(window).resize(function() {
//     if ( $(window).width() < 992) {
//        $('.side-filter-bar').css('display','none');
//     }
// });

$(window).resize(function() {
    if ($(window).width() > 991) {
       $('.side-filter-bar').css('display','block');
    }
});

// produt description page slider
$('.slider--product').owlCarousel({
    loop:false,
    margin:24,
    autoplay:false,
    responsiveClass:true,
    nav:false,
    margin:20,
    items:2,
     responsive:{
        780:{
            margin:10
        },
        1200:{
            items:3
        },
    }
})
// =====PRODUCT SLIDER========
$('.multiple-img:first').css('border', '1px solid #0D72A0');
var beforeclick = $('.multiple-img:first').children('.multiple-img-src').attr('src');
$('#zoom-image').attr('src' , beforeclick);

$('.multiple-img').click(function(){
     $('.multiple-img').css('border', 'none');
     var zoomimage = $(this).children('.multiple-img-src').attr('src');
     $(this).css('border', '1px solid #0D72A0');
     $('#zoom-image').attr('src' , zoomimage);
 });

// login and signup btn
 $('.add-address-btn').click(function() {
    $('.address-modal-outer').css('display','block');
    $('body').css('overflow','hidden');
});
$('.close-modal').click(function() {
    $('.address-modal-outer').css('display','none');
    $('body').css('overflow','auto');
});

//======FAQ PAGE==============
$(document).ready(function() {
    // make first active
     $(".question-field:first").addClass('active-ques');
     $(".question-field:first").find('.answer').slideDown(100);
     $(".question-field:first").find(".question-icon span").html("-");
    // accordian
  $(".question-field").on("click", function() {
    if ($(this).hasClass("active-ques")) {
      $(this).removeClass("active-ques");
      $(this).find(".answer").slideUp(200);
      $(this).find(".question-icon span").html("+");
    }
  else {
      $(".question-field").find(".question-icon span").html("+");
      $(".question-field").removeClass("active-ques");
      $(this).addClass("active-ques");
      $(".answer").slideUp(200);
      $(this).find(".answer").slideDown(200);
      $(this).find(".question-icon span").html("-");

    }
  });
 });
