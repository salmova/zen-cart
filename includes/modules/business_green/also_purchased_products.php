<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
* 
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS > 0 && MIN_DISPLAY_ALSO_PURCHASED > 0) {

  $also_purchased_products = $db->Execute(sprintf(SQL_ALSO_PURCHASED, (int)$_GET['products_id'], (int)$_GET['products_id']));

  $num_products_ordered = $also_purchased_products->RecordCount();

  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  // show only when 1 or more and equal to or greater than minimum set in admin
  if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED && $num_products_ordered > 0) {
    if ($num_products_ordered < SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
      $col_width = floor(100/$num_products_ordered);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS);
    }

    while (!$also_purchased_products->EOF) {
      $also_purchased_products->fields['products_name'] = zen_get_products_name($also_purchased_products->fields['products_id']);

	//##wel - additional class for last div in string
	if ($col == SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS - 1) {
		$additional_class = 'no-right-margin';
	} else {
		$additional_class = '';
	}
	//wel

    $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsAlsoPurch float-left ' . $additional_class . '"' . ' ' . 'style="width:' . $col_width . '%;"',
    'text' => (($also_purchased_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<div class="columnar-product-info"><div class="columnar-product-img"><a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'cPath=' . $productsInCategory[$also_purchased_products->fields['products_id']] . '&products_id=' . $also_purchased_products->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $also_purchased_products->fields['products_image'], $also_purchased_products->fields['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '</a></div>') . '<div class="product-box-name"><a href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'cPath=' . $productsInCategory[$also_purchased_products->fields['products_id']] . '&products_id=' . $also_purchased_products->fields['products_id']) . '">' . substr($also_purchased_products->fields['products_name'], 0, 40) . (strlen($also_purchased_products->fields['products_name']) > 40 ? "..." : "") . '</a></div>' . $products_price . '</div><a class="detail-link" href="' . zen_href_link(zen_get_info_page($also_purchased_products->fields['products_id']), 'cPath=' . $productsInCategory[$also_purchased_products->fields['products_id']] . '&products_id=' . $also_purchased_products->fields['products_id']) . '">'. DETAIL_LINK .'</a>');

      $col ++;
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $also_purchased_products->MoveNext();
    }
  }
  if ($also_purchased_products->RecordCount() > 0 && $also_purchased_products->RecordCount() >= MIN_DISPLAY_ALSO_PURCHASED) {
    $title = '<h2 class="centerBoxHeading">' . TEXT_ALSO_PURCHASED_PRODUCTS . '</h2>';
    $zc_show_also_purchased = true;
  }
}
?>