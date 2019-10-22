<?php

$option_name = 'true_options';

$o = get_option( $option_name );

switch ( $type ) {
	case 'text':
		$o[$id] = esc_attr( stripslashes($o[$id]) );
		echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	case 'textarea':
		$o[$id] = esc_attr( stripslashes($o[$id]) );
		echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o[$id]</textarea>";
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	case 'checkbox':
		$checked = ($o[$id] == 'on') ? " checked='checked'" :  '';
		echo "<label><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";
		echo ($desc != '') ? $desc : "";
		echo "</label>";
		break;
	case 'select':
		echo "<select id='$id' name='" . $option_name . "[$id]'>";
		foreach($vals as $v=>$l){
			$selected = ($o[$id] == $v) ? "selected='selected'" : '';
			echo "<option value='$v' $selected>$l</option>";
		}
		echo ($desc != '') ? $desc : "";
		echo "</select>";
		break;
	case 'radio':
		echo "<fieldset>";
		foreach($vals as $v=>$l){
			$checked = ($o[$id] == $v) ? "checked='checked'" : '';
			echo "<label><input type='radio' name='" . $option_name . "[$id]' value='$v' $checked />$l</label><br />";
		}
		echo "</fieldset>";
		break;
}
/*
 * Функция проверки правильности вводимых полей
 */

// Параметры плагина
//add_option('bc_position', __('left'));
//add_option('simple_basket_order_page', '');
//add_option('simple_basket_catalog_price', __('Price', 'simple_basket'));
//add_option('simple_basket_delivery', '0');
//add_option('simple_basket_delivery_default', '0');
//add_option('simple_basket_google_analytics_mode', '0');
//add_option('simple_basket_order_compete_virtual_page', '');
//add_option('simple_basket_conformation_email_post', '');
//add_option('simple_basket_conformation_email_subject', '');
//add_option('simple_basket_admin_email_post', '');
//add_option('simple_basket_admin_email_subject', '');
//
//
//// Принимаем данные
//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//{
//	if (isset($_POST['bc_position']))
//		update_option('bc_position', $_POST['bc_position']);
//
//	if (isset($_POST['orderpage']))
//		update_option('simple_basket_order_page', $_POST['orderpage']);
//
//	if (isset($_POST['pricefield']))
//		update_option('simple_basket_catalog_price', $_POST['pricefield']);
//
//	if (isset($_POST['deliverymode']))
//		update_option('simple_basket_delivery', '1');
//	else
//		update_option('simple_basket_delivery', '0');
//
//	if (isset($_POST['deliveryplan']))
//		update_option('simple_basket_delivery_default', $_POST['deliveryplan']);
//
//	if (isset($_POST['googleanalyticsmode']))
//		update_option('simple_basket_google_analytics_mode', $_POST['googleanalyticsmode']);
//
//	if (isset($_POST['ordercompletevirtualvage']))
//		update_option('simple_basket_order_compete_virtual_page', $_POST['ordercompletevirtualvage']);
//
//
//	if (isset($_POST['confirmationEmailSubject']))
//		update_option('simple_basket_conformation_email_subject', $_POST['confirmationEmailSubject']);
//	if (isset($_POST['confirmemail']))
//		update_option('simple_basket_conformation_email_post', $_POST['confirmemail']);
//
//	if (isset($_POST['adminEmailSubject']))
//		update_option('simple_basket_admin_email_subject', $_POST['adminEmailSubject']);
//	if (isset($_POST['adminemail']))
//		update_option('simple_basket_admin_email_post', $_POST['adminemail']);
//
//}


// Для списка SELECT
?>
