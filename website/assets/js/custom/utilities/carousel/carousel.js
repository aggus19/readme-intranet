window.addEventListener('load', function(){
    new Glider(this.document.querySelector('.carousel__lista'), {
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: '.carousel__indicadores',
        arrows: {
            prev: '.carousel__anterior',
            next: '.carousel__siguiente'
        },
        responsive: [
            {
              // screens greater than >= 775px
              breakpoint: 800,
              settings: {
                // Set to `auto` and provide item width to adjust to viewport
                slidesToShow: 3,
                slidesToScroll: 3,
                itemWidth: 150,
                duration: 0.25
              }
            },{
              // screens greater than >= 1024px
              breakpoint: 1024,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
                itemWidth: 150,
                duration: 0.25
              }
            }
        ]
    });
});
window.addEventListener('load', function(){
  new Glider(this.document.querySelector('.carousel__lista_2'), {
      slidesToShow: 2,
      slidesToScroll: 2,
      dots: '.carousel__indicadores_2',
      arrows: {
          prev: '.carousel__anterior_2',
          next: '.carousel__siguiente_2'
      },
      responsive: [
          {
            // screens greater than >= 775px
            breakpoint: 800,
            settings: {
              // Set to `auto` and provide item width to adjust to viewport
              slidesToShow: 3,
              slidesToScroll: 3,
              itemWidth: 150,
              duration: 0.25
            }
          },{
            // screens greater than >= 1024px
            breakpoint: 1024,
            settings: {
              slidesToShow: 5,
              slidesToScroll: 5,
              itemWidth: 150,
              duration: 0.25
            }
          }
      ]
  });
});