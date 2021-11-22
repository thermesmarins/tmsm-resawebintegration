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
        * package_id
        * hotel_id
        * nights
        * from
        * instead
        * fallback
        * suffix
    * Example 1: [resaweb_price hotel_id="GHT" package_id="1" nights="6"]
    * Example 2: [resaweb_price hotel_id="BEST" package_id="1" nights="6"] for best price with accommodation
    * Example 3: [resaweb_price hotel_id="BEST" package_id="1"] for best price with accommodation indifferent of duration