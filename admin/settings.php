<?php

$option_name = 'true_options';

$o = get_option( $option_name );

switch ( $type ) {
	case 'shortcode':
		$o[$id] = esc_attr( stripslashes($o[$id]) );
		if (!$o[$id])$o[$id] = '[breadcrumbs position="left" show_home_link=1 show_current=1]';
		echo "<div id='bc-message'>".__('Text copied!', 'Breadcrumbs')."</div>";
		echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' readonly />";
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	case 'text':
		echo "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	case 'color':
		$o[$id] = esc_attr( stripslashes($o[$id]) );
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		echo "<input class='bc-color' type='color' id='$id' name='" . $option_name . "[$id]' value='$o[$id]' />";
		if (strpos($user_agent, "Trident") == false)
		echo "<input class='bc-color-input' type='text' value='$o[$id]' />";
		echo ($desc != '') ? "<span class='description'> $desc</span>" : "";
		break;
	case 'textarea':
		$o[$id] = esc_attr( stripslashes($o[$id]) );
		echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='$id' name='" . $option_name . "[$id]'>$o[$id]</textarea>";
		echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	case 'checkbox':
		$checked = ($o[$id] == 'on' || $checked == 'on') ? " checked='checked'" :  '';
		echo "<label id='".$id."_label'><input type='checkbox' id='$id' name='" . $option_name . "[$id]' $checked /> ";
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

?>
