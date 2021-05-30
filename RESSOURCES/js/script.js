//swiper initialization

const swiper = new Swiper('.swiper-container', {


  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  slidesPerView: 'auto',
  spaceBetween: 30,
});


//testimonials flex-grow initialization
$(".item-m").addClass('expanded');
$(".item").click(function() {
  $(this).addClass('expanded');
  $(".item").not(this).each(function() {
      $(this).removeClass("expanded");    
  });
});