<?php 

$guid = (int)get_input('guid1');
$parent_guid = (int)get_input('guid2');

// create relationship
remove_entity_relationship($guid1, 'child-idea', $parent_guid);

forward("/ideas/view/$guid");
?>