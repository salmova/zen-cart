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
<div id="logoWrapper"><div id="logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></div></div>

<div align="right" class="float-right cart-header-wrapper">
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
				<img class="float-right" src="<? echo $template->get_template_dir('', DIR_WS_TEMPLATE, $current_page_base,'buttons');?>/english/button_checkout.gif" />
				</td>
				<?php }?>
			</tr>
			</table>
</div>

<div class="clearRight"></div>

<div id="login_logout_section" class="float-right">
<?php if ($_SESSION['customer_id']) { ?>
    <ul class="list-style-none inline-list">
	<li>
		<?php echo(TOP_MENU_HELLO);?><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo ($_SESSION['customer_first_name'].' '.$_SESSION['customer_last_name']);?></a>
	</li>
    <li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
	</ul>
<?php
      } else {
        if (STORE_STATUS == '0') {
?>
	<?php echo LOGIN_WELCOME . ","; ?>
    <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a>
	<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
	<?php echo REGISTER_WELCOME; ?>
    <a href="<?php echo zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_REGISTER; ?></a>
<?php } } ?>

</div>


<div class="clearBoth" /></div>
<!--eof-branding display-->

<!--eof-header logo and navigation display-->

<?php require($template->get_template_dir('tpl_top_nav.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_top_nav.php'); ?>

<!--bof-optional categories tabs navigation display-->
<?php/*
if (CATEGORIES_TABS_STATUS == '1') 
require($template->get_template_dir('tpl_modules_categories_tabs.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_categories_tabs.php'); 
*/
?>
<!--eof-optional categories tabs navigation display-->


</div>
<?php } ?>