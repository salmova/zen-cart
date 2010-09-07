<?php
/**
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

  require('includes/application_top.php');
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  //define settings for the template
  $template_settings_configuration = array (

  "SHOW_COUNTS" => 'true',
  "COLUMN_RIGHT_STATUS" => 1,
  "COLUMN_LEFT_STATUS" => 1,
  

  "BOX_WIDTH_LEFT" => '180px',
  "BOX_WIDTH_RIGHT" => '180px',
  "COLUMN_WIDTH_LEFT" => '180px',
  "COLUMN_WIDTH_RIGHT" => '180px',

  "CATEGORIES_SEPARATOR" => '',
  "CATEGORIES_SEPARATOR_SUBS" => '',
  "CATEGORIES_SUBCATEGORIES_INDENT" => '&nbsp;',

 /* "PRODUCTS_PRICE_IS_CALL_IMAGE_ON" => 0,*/
  "PRODUCT_INFO_PREVIOUS_NEXT" => 2,
  "SHOW_FOOTER_IP" => 0,
  "SHOW_BANNERS_GROUP_SET6" => '',

  "SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS" => 4,
  "OTHER_IMAGE_PRICE_IS_FREE_ON" => 0,
  "SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS" => 4,
  "SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS" => 4,
  "SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS" => 4,


  "PRODUCT_LIST_CATEGORIES_IMAGE_STATUS" => 'false',
  "PRODUCT_LIST_CATEGORIES_IMAGE_STATUS_TOP" => 'false',


  "SMALL_IMAGE_WIDTH" => 122,
  "SMALL_IMAGE_HEIGHT" => 100,


  "MEDIUM_IMAGE_WIDTH" => 180,
  "MEDIUM_IMAGE_HEIGHT" => 160,

/*
  "SUBCATEGORY_IMAGE_WIDTH" => 150,
  "SUBCATEGORY_IMAGE_HEIGHT" => 140,
*/
  "IMAGE_PRODUCT_LISTING_WIDTH" => 124,
  "IMAGE_PRODUCT_LISTING_HEIGHT" => 100,

  "IMAGE_PRODUCT_NEW_LISTING_WIDTH" => 124,
  "IMAGE_PRODUCT_NEW_LISTING_HEIGHT" => 100,

  "IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH" => 124,
  "IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT" => 100,
  
 "IMAGE_PRODUCT_ALL_LISTING_WIDTH" => 124,
  "IMAGE_PRODUCT_ALL_LISTING_HEIGHT" => 100,


  "IMAGE_PRODUCT_NEW_WIDTH" => 124,
  "IMAGE_PRODUCT_NEW_HEIGHT" => 100,


  "MAX_MANUFACTURERS_LIST" => 1,
  "MAX_DISPLAY_NEW_PRODUCTS" => 8,
  "MAX_DISPLAY_SEARCH_RESULTS_FEATURED" => 8,
  "MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX" => 8,
  "MAX_DISPLAY_SPECIAL_PRODUCTS" => 12,
  "MAX_DISPLAY_UPCOMING_PRODUCTS" => 8,
  "MAX_DISPLAY_ALSO_PURCHASED" => 8,

  "EZPAGES_SEPARATOR_FOOTER" => '',
  );
  $template_settings_layout_boxes = array (

  "document_categories.php" => array("layout_box_status" => 0),
  "featured.php" => array("layout_box_status" => 0),
  "reviews.php" => array("layout_box_status" => 0),
  "more_information.php" => array("layout_box_status" => 1, "layout_box_location" => 1),
  "whats_new.php" => array("layout_box_status" => 0),
  "best_sellers.php" => array("layout_box_location" => 0),

  "search.php" => array("layout_box_status" => 0, "layout_box_sort_order" => 10),
  "tell_a_friend.php" => array("layout_box_location" => 1),
  "languages.php" => array("layout_box_status" => 0),
  "music_genres.php" => array("layout_box_status" => 0),
  "record_companies.php" => array("layout_box_status" => 0),
  "specials.php" => array("layout_box_status" => 0),

  "whos_online.php" => array("layout_box_location" => 1),
  "product_notifications.php" => array("layout_box_status" => 0),
  "order_history.php" => array("layout_box_status" => 0),
  "banner_box.php" => array("layout_box_status" => 0, "layout_box_location" => 1),
  "banner_box2.php" => array("layout_box_status" => 0),
  "banner_box_all.php" => array("layout_box_status" => 0),
  "shopping_cart.php" => array("layout_box_status" => 0),
  "currencies.php" => array("layout_box_status" => 1, "layout_box_location" => 1, "layout_box_sort_order" => -9),

  "information.php" => array("layout_box_location" => 1),
  "ezpages.php" => array("layout_box_location" => 1),
  );
  $template_is_set = false;
  
  if (stripos($template_dir, CHOCCY_LITE_TEMPLATE_DIR) !== false) $template_is_set = true;
   
  if (zen_not_null($action)) {
    switch ($action)    {
    case 'apply':
        if ($template_is_set){ 
            foreach ($template_settings_configuration as $k=>$v){
                $db->Execute("UPDATE ". TABLE_CONFIGURATION ." SET configuration_value='". $v ."' WHERE configuration_key='". $k ."'");                
            }
            foreach ($template_settings_layout_boxes as $k=>$v){
                foreach ($v as $i=>$z){
                    $db->Execute("UPDATE ". TABLE_LAYOUT_BOXES ." SET ". $i ."='". $z ."' WHERE layout_box_name='". $k ."' AND layout_template='". $template_dir ."'");                
                }
            }
        $messageStack->add_session(SUCCESS_SETTINGS_APPLIED . $template_dir, 'success');
        }
    break;
    }
    zen_redirect(zen_href_link(FILENAME_CHOCCY_LITE, '','NONSSL'));
   } 
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table width="100%" cellspacing="2" cellpadding="10" border="0">
<tbody>
        <tr>
            <td class="pageHeading"><?php echo CONFIGURE_CHOCCY_LITE_SKIN_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo '<a href="javascript:history.back()">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
        </tr>
        <tr>
            <td class="pageHeading" colspan="2" align="right"><?php echo zen_draw_separator(); ?></td>
        </tr>
<?php
        if ($template_is_set){
?>
        <tr>
            <td colspan="2" align="left">
            <a href="<?php echo zen_href_link(FILENAME_CHOCCY_LITE, '&action=apply') ?>"><?php echo zen_image_button('button_apply_settings_ch.gif', APPLY_SETTINGS); ?></a>
            </td>
        </tr>
<?php
        } else {
?>
        <tr>
            <td colspan="2" align="left">
            <p><?php echo CHOCCY_LITE_NAME;?> is not applied for the storefront. It should be set before configuring.</p>
            <p><a href="<?php echo zen_href_link(FILENAME_TEMPLATE_SELECT, '', 'NONSSL')?>">Click to go to the 'Template selection' page</a></p>
            </td>
        </tr>      
<?php
        }
?>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>