<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
*
* Common Template
* 
* @package languageDefines
* @copyright Copyright 2009-2010 12leaves.com
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_header.php 4813 2006-10-23 02:13:53Z drbyte $
*/
?>

<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}

?>


<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>

<div id="headerWrapper">

<!--bof-branding display-->
<div id="logoWrapper">
    <div id="logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></div>
<!--eof-branding display-->



<!--bof-header ezpage links-->
<div class="topper-menu float-right">
<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
<?php } ?>
</div>
<!--eof-header ezpage links-->



<div class="clearRight"/></div>


<!--cat tabs login section-->
		<div id="login_logout_section" class="cat-tabs-login float-right">
		<ul class="list-style-none inline-list">
<?php if ($_SESSION['customer_id']) { ?>
			<li>
			<a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo ($_SESSION['customer_first_name'].' '.$_SESSION['customer_last_name']);?></a>
			</li>
		    <li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
<?php
      } else {
        if (STORE_STATUS == '0') {
?>
	    <li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a></li>
		<li><?php echo HEADER_OR; ?></li>
	    <li><a href="<?php echo zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_REGISTER; ?></a></li>
<?php } } ?>
		</ul>

		</div>
<!-- /cat tabs login section-->

</div>


<?php
require($template->get_template_dir('tpl_top_nav.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_top_nav.php'); 
?>


<?php
if ($this_is_home_page) {
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
}   
?>

<!-- tools section -->
<div id="tools_wrapper" class="align-center">
		<div class="tools-nav-left"></div>
		<div class="tools-nav-right"></div>

		<div class="float-left td-search-header">
			<div class="search-header float-left">
	            <?php require($template->get_template_dir('tpl_search_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_search_header.php');?>
	    		<div class="advanced_search float-left">
	                <a href="index.php?main_page=advanced_search"><?php echo HEADER_ADVANCED_SEARCH; ?></a>
	            </div>
			</div>
	    </div>
		<div align="right" class="float-right td-languages">

			<!-- header cart section -->
			<table align="right" class="align-center cart-header">
			<tr>
				<td>
				<?php require($template->get_template_dir('tpl_shopping_cart_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_shopping_cart_header.php'); 
				echo $content;
				/*require($template->get_template_dir('tpl_box_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_box_header.php');*/?>		
				</td>
				<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
				<td>&nbsp;|<td>
				<td class="blue-link">
					<a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a>
				</td>
				<?php }?>
			</tr>
			</table>
    	</div>

</div>
<!-- /tools section -->

<div class="clearBoth"></div>

</div>
<?php } ?>