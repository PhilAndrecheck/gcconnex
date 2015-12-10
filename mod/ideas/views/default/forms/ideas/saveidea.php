<?php
/**
 * Edit / add an idea
 *
 * @package ideas
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars, elgg_get_page_owner_guid());
$guid = elgg_extract('guid', $vars, null);
$user = elgg_get_logged_in_user_guid();

?>

<div>
	<label for="title"><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'id' => 'title', 'value' => $title)); ?>
</div>
<div>
	<label for="description"><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'id' => 'description', 'value' => $desc)); ?>
</div>

<div class="mrgn-tp-md">
    <label for="book_themes">Themes</label>
    <?php 
        echo elgg_view('input/select', array(
	       'name' => 'themes',
	       'id' => 'book_themes',
	       'value' => $vars['status'],
	       'options_values' => array(
               //We need a loop here to loop through the themes chosen by the book owner
               //I have put placeholder themes for now (they are not dynamic)
		      'theme1' => 'Theme 1',
		      'theme2' => 'Theme 2'
	       )
));
    
    ?>
</div>
<div class="mrgn-tp-sm mrgn-bttm-md">
	<label for="tags"><?php echo elgg_echo('tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'id' => 'tags', 'value' => $tags)); ?>
</div>
<?php

$categories = elgg_view('input/categories', $vars);
if ($categories) {
	echo $categories;
}

?>

<div class="elgg-foot">
	<?php

	echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

	if ($guid) {
		echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	}

	echo elgg_view('input/submit', array('value' => elgg_echo("save")));

	?>
</div>