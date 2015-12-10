<?php 

$guid = (int)get_input('guid1');
$parent_guid = (int)get_input('guid2');

// create relationship
add_entity_relationship($guid, 'child-idea', $parent_guid);

forward("/ideas/view/$parent_guid");
?>