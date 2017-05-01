;(function ($) {

  //console.log('resaweb-load');

  $('.resaweb-load').each(function (e) {
    hotel_id = $(this).data('hotelid');
    package_id = $(this).data('packageid');
    trip_id = $(this).data('tripid');
    nights = $(this).data('nights');
    lang = $(this).data('lang');
    $.ajax({
      url: 'https://reservation.thalassotherapie.com/api/v1/price-search',
      method: 'get',
      dataType: 'json',
      data: {
        hotel_id: hotel_id,
        package_id: [package_id],
        trip_id: trip_id,
        duration: nights,
        lang: lang
      },
      success: function (data) {

        $.each(data, function (i, item) {
          $('.resaweb-price[data-hotelid="' + item.place.codename + '"][data-packageid="' + item.package_main.package_id + '"][data-nights="' + item.nights_nb + '"]').html((lang=='en'?'€':'')+item.price_perperson_discounted+(lang!='en'?'&nbsp;€':'')).attr(
            'data-packageslug', item.package_main.slug).attr('data-resawebdone', 'ok');
        });

      },
      error: function (data, textStatus, errorThrown) {
        //console.log('error2');
      }
    });
  });

}(jQuery));