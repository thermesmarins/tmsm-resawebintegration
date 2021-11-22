;(function ($) {

  assignPrice = function(PriceWithCurrencyFrom, PriceWithCurrencyInstead, shortcode, item){
    $('.pricevalue', shortcode).html(PriceWithCurrencyFrom);

    if (PriceWithCurrencyInstead !== PriceWithCurrencyFrom) {
      $('.insteadvalue', shortcode).html(PriceWithCurrencyInstead);
    }
    else {
      $('.instead', shortcode).remove();
    }
    if (PriceWithCurrencyFrom) {
      $('*', shortcode).show();
      $('.fallback', shortcode).hide();
    }

    shortcode.attr('data-packageslug', item.package_main.slug).attr('data-resawebdone', 'ok').attr('data-pricevalue', item.price_perperson_discounted).attr('data-insteadvalue',
      item.price_perperson_regular);
  };


  $('.resaweb-load').each(function (e) {
    hotel_id = $(this).data('hotelid');
    package_id = $(this).data('packageid');
    trip_id = $(this).data('tripid');
    nights = $(this).data('nights');
    $.ajax({
      //url: 'https://reservation.thalasso-saintmalo.com/fr/api/v1/price-search',
      url: 'http://resaweb.lndo.site/fr/api/v1/price-search',
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

          // Format price to i18n
          var PriceWithCurrencyFrom = Number(item.price_perperson_discounted).toLocaleString(tmsm_resawebintegration_params.locale, {style: "currency", currency: tmsm_resawebintegration_params.options.currency, minimumFractionDigits: 0, maximumFractionDigits: 2});
          var PriceWithCurrencyInstead = Number(item.price_perperson_regular).toLocaleString(tmsm_resawebintegration_params.locale, {style: "currency", currency: tmsm_resawebintegration_params.options.currency, minimumFractionDigits: 0, maximumFractionDigits: 2});

          // Assign prices hotel shortcodes
          $('.resaweb-price[data-hotelid="' + item.place.codename + '"][data-packageid="' + item.package_main.package_id + '"][data-nights="' + item.nights_nb + '"]').each(function () {
            var shortcode = $(this);

            assignPrice(PriceWithCurrencyFrom, PriceWithCurrencyInstead, shortcode, item);

          });

          // Assign prices BEST shortcodes
          $('.resaweb-price[data-hotelid="BEST"][data-packageid="' + item.package_main.package_id + '"]').each(function () {
            var shortcode = $(this);

            // Exclude without accommodation
            if(item.place.codename === 'TMS'){
              return true;
            }

            // Exclude not matching number of nights
            if(shortcode.attr('data-nights')){
              if(shortcode.attr('data-nights') !== item.nights_nb){
                return true;
              }
            }

            // Compare existing price
            if(shortcode.attr('data-pricevalue') && parseInt(item.price_perperson_discounted) > parseInt(shortcode.attr('data-pricevalue'))){
              return true;
            }

            assignPrice(PriceWithCurrencyFrom, PriceWithCurrencyInstead, shortcode, item);

          });


        });

      },
      error: function (data, textStatus, errorThrown) {
      }
    });
  });

}(jQuery));