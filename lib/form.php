<?php
function input($id){
	$value = isset($_POST[$id]) ? $_POST[$id] : '';
	return "<input type ='text' class='form_control input-sm' id='$id' name='$id' value='$value''>" ;
}

function textarea($id){
	$value = isset($_POST[$id]) ? $_POST[$id] : '';
	return "<textarea type='text' class='form_control input-sm' id='$id' name='$id'>$value</textarea>" ;
}

function select($id, $options = array()){
	$return = "<select class='form_control input-sm' id='$id' name='$id'>";
	foreach ($options as $k => $v) {
		$selected = '';
		if(isset($_POST[$id]) && $k == $_POST[$id]){
			$selected = ' selected ="selected"';
		}
		$return .= "<option value='$k' $selected>$v</option>";
	}
	$return.= '</select>';
	return $return;
}

function background($number){
	switch($number){
		case 0: $return = 'background: #092140; color: #FFFFFF';
			break;
		case 1: $return = 'background: #024959; color: #FFFFFF';
			break;
		case 2: $return = 'background: #F2C777';
			break;
		case 3: $return = 'background: #F24738';
			break;
		case 4: $return = 'background: #BF2A2A';
			break;
	}
	return $return;
}