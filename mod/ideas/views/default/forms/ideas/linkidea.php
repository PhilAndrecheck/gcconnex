<?php

$child_id = elgg_extract('child-id', $vars, '');

?>

<div>
	<label><?php echo elgg_echo('ideas:parent:inputid'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'parent_id', 'value' => "")); ?>
</div>

<div class="elgg-foot">
	<?php

	echo elgg_view('input/hidden', array('name' => 'child_id', 'value' => $child_id));

	echo elgg_view('input/submit', array('value' => elgg_echo("link")));

	?>
