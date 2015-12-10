<?php

$children_guids = (int)get_input('children_guids');
$parent_guid = (int)get_input('guid');


foreach( $children_guids as $child )
	remove_entity_relationship($child, 'child-idea', $parent_guid);

forward("/ideas/view/$parent_guid");
?>