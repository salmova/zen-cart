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

// initialize vars
$categories_products_id_list = '';
$list_of_products = '';
$featured_products_query = '';
$display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1 and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
    $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                                from (" . TABLE_PRODUCTS . " p
                                left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                                left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id)
                                where p.products_id = f.products_id
                                and p.products_id = pd.products_id
                                and p.products_status = 1 and f.status = 1
                                and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and p.products_id in (" . $list_of_products . ")";
  }
}
if ($featured_products_query != '') $featured_products = $db->ExecuteRandomMulti($featured_products_query, MAX_DISPLAY_SEARCH_RESULTS_FEATURED);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($featured_products_query == '') ? 0 : $featured_products->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS == 0) {
    $col_width = floor(100/$num_products_count);
  } else {
    $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS);
  }
  while (!$featured_products->EOF) {
    $products_price = zen_get_products_display_price_bus($featured_products->fields['products_id']);
    if (!isset($productsInCategory[$featured_products->fields['products_id']])) $productsInCategory[$featured_products->fields['products_id']] = zen_get_generated_category_path_rev($featured_products->fields['master_categories_id']);

	//##wel - additional class for last div in string
	if ($col == SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS - 1) {
		$additional_class = 'no-right-margin';
	} else {
		$additional_class = '';
	}
	//wel

    $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsFeatured float-left ' . $additional_class . '"' . ' ' . 'style="width:' . $col_width . '%;"',
    'text' => (($featured_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<div class="columnar-product-info"><div class="columnar-product-img"><a href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $featured_products->fields['products_image'], $featured_products->fields['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '</a></div>') . '<div class="product-box-name"><a href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '">' . substr($featured_products->fields['products_name'], 0, 40) . (strlen($featured_products->fields['products_name']) > 40 ? "..." : "") . '</a></div>' . $products_price . '</div><a class="detail-link" href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '">'. DETAIL_LINK .'</a>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $featured_products->MoveNextRandom();
  }

  if ($featured_products->RecordCount() > 0) {
    if (isset($new_products_category_id) && $new_products_category_id !=0) {
      $category_title = zen_get_categories_name((int)$new_products_category_id);
      $title = '<h2 class="centerBoxHeading">' . TABLE_HEADING_FEATURED_PRODUCTS . ($category_title != '' ? ' - ' . $category_title : '') . '</h2>';
    } else {
      $title = '<h2 class="centerBoxHeading">' . TABLE_HEADING_FEATURED_PRODUCTS . '</h2>';
    }
    $zc_show_featured = true;
  }
}
?>