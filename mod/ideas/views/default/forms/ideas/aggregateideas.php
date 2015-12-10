<?php

$parent_id = elgg_extract('parent-id', $vars, '');


?>

<div>
	<label for="aggregation-tag"><?php echo elgg_echo('ideas:aggregation:tag'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'aggregation-tag', 'id' =>'aggregation-tag', 'value' => "")); ?>
</div>

<div class="elgg-foot">
	<?php

	echo elgg_view('input/hidden', array('name' => 'parent_id', 'value' => $parent_id));

	echo elgg_view('input/submit', array('value' => elgg_echo("aggregate"), 'class' => 'mrgn-tp-sm'));

	?>
