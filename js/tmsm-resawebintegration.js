;(function ($) {
  con
  $('.resaweb-load').each(function (e) {
    hotel_id = $(this).data('hotelid');
    package_id = $(this).data('packageid');
    trip_id = $(this).data('tripid');
    nights = $(this).data('nights');
    $.ajax({
      url: 'https://reservation.thalassotherapie.com/api/v1/price-search',
      method: 'get',
      dataType: 'json',
      data: {
        hotel_id: hotel_id,
        package_id: [package_id],
        trip_id: trip_id,
        duration: nights
      },
      success: function (data) {

        $.each(data, function (i, item) {
          var shortcode = $('.resaweb-price[data-hotelid="' + item.place.codename + '"][data-packageid="' + item.package_main.package_id + '"][data-nights="' + item.nights_nb + '"]');

          var PriceWithCurrencyFrom = Number(item.price_perperson_discounted).toLocaleString(tmsm_resawebintegration_params.locale, {style: "currency", currency: tmsm_resawebintegration_params.options.currency, minimumFractionDigits: 0, maximumFractionDigits: 2});
          var PriceWithCurrencyInstead = Number(item.price_perperson_regular).toLocaleString(tmsm_resawebintegration_params.locale, {style: "currency", currency: tmsm_resawebintegration_params.options.currency, minimumFractionDigits: 0, maximumFractionDigits: 2});

          $('.pricevalue', shortcode).html(PriceWithCurrencyFrom);

          if(PriceWithCurrencyInstead !== PriceWithCurrencyFrom) {
            $('.insteadvalue', shortcode).html(PriceWithCurrencyInstead);
          }
          else{
            $('.instead', shortcode).remove();
          }
          if(PriceWithCurrencyFrom){
            $('*', shortcode).show();
            $('.fallback', shortcode).hide();
          }

          shortcode.attr( 'data-packageslug', item.package_main.slug).attr('data-resawebdone', 'ok');
        });

      },
      error: function (data, textStatus, errorThrown) {
      }
    });
  });

}(jQuery));