<?php
/**
 * Edit form body for external pages
 * 
 * @uses $vars['type']
 * 
 */

$type = $vars['type'];

//grab the required entity
$page_contents = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => $type,
	'limit' => 1,
));

if ($page_contents) {
	$description = $page_contents[0]->description;
	$guid = $page_contents[0]->guid;
} else {
	$description = "";
	$guid = 0;
}

// set the required form variables
$input_area = elgg_view('input/longtext', array(
	'internalname' => 'expagescontent',
	'value' => $description,
));
$submit_input = elgg_view('input/submit', array(
	'internalname' => 'submit',
	'value' => elgg_echo('save'),
));
$hidden_type = elgg_view('input/hidden', array(
	'internalname' => 'content_type',
	'value' => $type,
));
$hidden_guid = elgg_view('input/hidden', array(
	'internalname' => 'guid',
	'value' => $guid,
));

$external_page_title = elgg_echo("expages:$type");

//construct the form
echo <<<EOT
<h3 class="mvm">$external_page_title</h3>
<div>$input_area</div>
	$hidden_value
	$hidden_type
	$submit_input

EOT;
