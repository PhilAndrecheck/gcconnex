<?php 
/*
gatekeeper();
group_gatekeeper();
*/
$child_guid = (int)get_input('child_id');
$parent_guid = (int)get_input('parent_id');

// create relationship
add_entity_relationship($child_guid, 'child-idea', $parent_guid);

forward("/ideas/view/$parent_guid");
?>