<?php 
/**
 * Group entity view
 * 
 * @package ElggGroups
 */

$group = $vars['entity'];
$lang = get_current_language();
if(elgg_get_context() == 'widgets' || elgg_get_context() == 'custom_index_widgets'){
    $icon = elgg_view_entity_icon($group, 'small', $vars);
} else {
    $icon = elgg_view_entity_icon($group, 'medium', $vars);
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $group,
	'handler' => 'groups',
	'sort_by' => 'priority',
	'class' => 'list-inline',
));



if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	//Give widget stuff entity menu
    //$metadata = '';
}


if ($vars['full_view']) {
	echo elgg_view('groups/profile/summary', $vars);
} else {
	// brief view
	$params = array(
		'entity' => $group,
		'metadata' => $metadata,
	);
if($group->briefdescription3){
	$params2 = array(
		'subtitle' => gc_explode_translation($group->briefdescription3,$lang),
	);
}elseif($group->briefdescription2){
	$params2 = array(
		'subtitle' => $group->briefdescription2,
	);
}else{
		$params2 = array(
		'subtitle' => $group->briefdescription,
	);
}


	$params = $params + $params2;
	$params = $params + $vars;
	$list_body = elgg_view('group/elements/summary', $params);

	echo elgg_view_image_block($icon, $list_body, $vars);
}
