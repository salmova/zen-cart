/***********************************************
 * Images Slideshow  GXBanner - (c) www.12leaves.com - ecommerce webdesign services
 ***********************************************/


ADD OR REMOVE THE IMAGES FROM THE SLIDESHOW BANNER
==================================================

To add/remove the image to/from the slideshow banner you should:
1. Place/remove the new image to/from the 'images' folder
2. Add/remove the HTML containers for the new image and new banner page to/from the banner HTML code.
   HTML container for the image:

   <div class="slide">
    <a href="#"><img src="images/your_image.jpg" alt="" /></a>
   </div>

   HTML container for the new banner page:

   <a href="#" class="page">PAGE NUMBER</a>

   The 'index_demo.html' demo file has the descriptions where you should paste the HTML containers 
   and what settings are available for the banner.

   PLEASE NOTE, the actual file you should edit is located at the 'YOUR_ZEN_CART/includes/languages/english/html_includes/TEMPLATE_VARIATION/define_main_page.php'.
   You can also edit this file via 'Tools -> Define Pages Editor' section of the admin area. All the banner settings you want to adjust (switching pause, switching effect, speed, pagination effect) are in this file.


SLIDESHOW BANNER SETTINGS
=========================

The 'styles_gx.css' file has the styles for the slideshow banner. You can change the banner height, width, pagination position (center, left, right),
color, borders etc. All the necessary descriptions are in the the 'styles_gx.css' file of the banner folder.

All the banner settings you want to adjust (switching pause, switching effect, speed, pagination effect) are in the 'YOUR_ZEN_CART/includes/languages/english/html_includes/TEMPLATE_VARIATION/define_main_page.php' file.
You can also edit this file via 'Tools -> Define Pages Editor' section of the admin area.





