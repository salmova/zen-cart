<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
 * 
 * Module Template - categories_tabs with dropdown product menus
 *
 * Template stub used to display categories-tabs output
 *
 * @package templateSystem
 * @copyright Copyright 2008-2009 12leaves.com
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_categories_tabs.php 3395 2006-04-08 21:13:00Z ajeh $
 */
?>

<?php
	echo '<div id="navCatTabsWrapper">';
	echo '<div id="navCatTabs">';
	echo '<div id="navCatDropdown">';
	echo '<ul class="ul-wrapper">';

	$categories_tab_query = "SELECT c.categories_id, cd.categories_name FROM ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id=cd.categories_id AND c.parent_id= '0' AND cd.language_id='" . (int)$_SESSION['languages_id'] . "' AND c.categories_status='1' ORDER BY c.sort_order, cd.categories_name;";
	$categories_tab = $db->Execute($categories_tab_query);

	while (!$categories_tab->EOF) 
	{
		echo '<li class="root-cat">';
		if((int)$cPath == $categories_tab->fields['categories_id']) 
			echo '<a class="tab-category-top selected-cat" href="'.zen_href_link(FILENAME_DEFAULT,'cPath=' . (int)$categories_tab->fields['categories_id']).'">' . $categories_tab->fields['categories_name']; 

		 //echo '<span class="">'.$categories_tab->fields['categories_name'].'</span>';
		else 
			echo '<a class="tab-category-top" href="'.zen_href_link(FILENAME_DEFAULT,'cPath=' . (int)$categories_tab->fields['categories_id']).'">' . $categories_tab->fields['categories_name']; 
		 //echo $categories_tab->fields['categories_name'];

		echo '</a>';
		$subcategories_tab_query="SELECT c.categories_id, cd.categories_name FROM ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id=cd.categories_id AND c.parent_id= '".(int)$categories_tab->fields['categories_id']."' AND cd.language_id='" . (int)$_SESSION['languages_id'] . "' AND c.categories_status='1' ORDER BY c.sort_order, cd.categories_name;";
		$subcategories_tab=$db->Execute($subcategories_tab_query);
		if($subcategories_tab->RecordCount()>0)
		{
			echo '<ul>';
			while (!$subcategories_tab->EOF) 
			{
				$cPath_new='cPath=' . $categories_tab->fields['categories_id'] . '_' . $subcategories_tab->fields['categories_id'];
				$cPath_new=str_replace('=0_', '=', $cPath_new);
				echo '<li class="sub-cat">'.'<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '">'.$subcategories_tab->fields['categories_name'].'</a></li>';
				$subcategories_tab->MoveNext();
			}
			echo '</ul>';
		}

		$categories_tab->MoveNext();
	}
	echo '</ul>';
    echo '<div class="clearBoth" style="font-size: 0;"><img src="'. $template->get_template_dir('', DIR_WS_TEMPLATE, $current_page_base,'images') . '/spacer.gif" width="2" height="1"/></div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';

?>


<!--[if IE 7]>
<script>
(function() {
	var zIndexNumber = 1000;
	var els = document.getElementById('navCatDropdown').getElementsByTagName('li');
	var i;
	for (i = 0; i < els.length; i++) {
		els[i].style.zIndex = zIndexNumber;
		zIndexNumber -= 10;
	};
})();

</script>
<![endif]-->
