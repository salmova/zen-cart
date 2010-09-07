<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
*
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: index.php 6550 2007-07-05 03:54:54Z drbyte $
*/    
?>

<div id="top_nav">
<div id="tab_nav">
<!--<div class="top-nav-left"></div>-->
<div class="top-nav-right"></div>
	<ul class="list-style-none">
		<li class="home-link"><a href="<?php echo '' . HTTP_SERVER . DIR_WS_CATALOG;?>"><?php echo TOP_MENU_HOME;?></a></li>

<?php
if ($current_page_base == 'products_new') {	$active	= 'tab_active'; 
	} else { $active = '';
}?>
		<li class="<?php echo $active;?>"><a href="index.php?main_page=products_new"><?php echo TOP_MENU_NEW_PRODUCTS;?></a></li>

<?php
if ($current_page_base == 'specials') { $active = 'tab_active'; 
	} else { $active = '';
}?>
		<li class="<?php echo $active;?>"><a href="index.php?main_page=specials"><?php echo TOP_MENU_SPECIALS;?></a></li>

<?php 
if ($current_page_base == 'featured_products') { $active = 'tab_active'; 
	} else { $active = '';
}?>
		<li class="<?php echo $active;?>"><a href="index.php?main_page=featured_products"><?php echo TOP_MENU_FEATURED_PRODUCTS;?></a></li>

<?php
if ($current_page_base == 'account' || $current_page_base == 'login' || $current_page_base == 'account_edit' || $current_page_base == 'address_book' || $current_page_base == 'account_password' || $current_page_base == 'account_newsletters' || $current_page_base == 'account_notifications') { $active = 'tab_active'; 
	} else { $active = '';
}?>
		<li class="<?php echo $active;?>"><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo TOP_MENU_MY_ACCOUNT;?></a></li>

<?php
if ($current_page_base == 'shopping_cart') { $active = 'tab_active'; 
	} else { $active = '';
}?>
		<li class="<?php echo $active;?>"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>"><?php echo TOP_MENU_VIEW_CART;?></a></li>
	</ul>
</div>


<div id="login_logout_section" class="float-right">
    <ul class="list-style-none inline-list">
<?php if ($_SESSION['customer_id']) { ?>
	<li>
		<?php echo(TOP_MENU_HELLO);?><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo ($_SESSION['customer_first_name'].' '.$_SESSION['customer_last_name']);?></a>
	</li>
    <li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
	</ul>
<?php
      } else {
        if (STORE_STATUS == '0') {
?>
    <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a>
	<?php echo HEADER_OR; ?>
    <a href="<?php echo zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_REGISTER; ?></a>
<?php } } ?>

</div>
<div class="clearBoth"></div>
</div>