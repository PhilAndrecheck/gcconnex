<?php

$parent_guid = (int)get_input('guid');
$parent = get_entity($parent_guid);

$children = $parent->getEntitiesFromRelationship( array( 'relationship' => 'child-idea', 'inverse_relationship' => true ) );

foreach( $children as $child )
	remove_entity_relationship($child->guid, 'child-idea', $parent_guid);

?>