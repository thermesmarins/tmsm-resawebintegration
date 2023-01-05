TMSM Resaweb Integration 
=================

Features
-----------

* Uses Prices API
* Shortcode for loading prices:
    * [resaweb_load]
    * Attributes:
        * package_id
        * trip_id
        * hotel_id
        * nights
    * Example 1: [resaweb_load package_id="1"] - Load all prices for package_id = 1
    * Example 2: [resaweb_load hotel_id="GHT" package_id="1"] - Load price for package_id=1 in hotel_id=GHT
* Shortcode for displaying a price:
    * [resaweb_price]
    * Attributes:
        * package_id (integer value, of the package ID)
        * hotel_id (text value, codename of the place  accommodation or treatments center)
        * nights (integer value, number of nights)
        * from (when =1, adds prefix "From" to the price)
        * instead (when =1, adds suffix "instead of" when there is a discount)
        * fallback (when =1, shows "Check availability" when there is no price)
        * suffix (text value, added as a suffix after the price)
    * Example 1: [resaweb_price hotel_id="GHT" package_id="1" nights="6"]
    * Example 2: [resaweb_price hotel_id="BEST" package_id="1" nights="6"] for best price with accommodation
    * Example 3: [resaweb_price hotel_id="BEST" package_id="1"] for best price with accommodation indifferent of duration    
    * Example 4: [resaweb_price hotel_id="BEST" package_id="1" from="1"] displays "From XXX€"