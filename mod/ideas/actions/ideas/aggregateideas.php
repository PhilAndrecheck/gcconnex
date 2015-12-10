<?php

$tag = (int)get_input('aggregation-tag');
$parent_guid = (int)get_input('parent_id');

$children_guids = elgg_get_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'idea',
	'limit' => 100,
	'metadata_names' => array('tags'),
	'metadata_values' => array($tag)
));

foreach( $children_guids as $child )
	add_entity_relationship($child, 'child-idea', $parent_guid);

forward("/ideas/view/$parent_guid");
?>