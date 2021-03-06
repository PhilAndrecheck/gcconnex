<?php
/*
 * Author: National Research Council Canada
 * Website: http://www.nrc-cnrc.gc.ca/eng/rd/ict/
 *
 * License: Creative Commons Attribution 3.0 Unported License
 * Copyright: Her Majesty the Queen in Right of Canada, 2015
 */
 
/*
 * Form which allows users to post a message to The Wire about the subject mission entity.
 */
$entity = $vars['entity_subject'];

$char_limit = (int)elgg_get_plugin_setting('limit', 'thewire');
$rows = 2;
if($char_limit > 140) {
	$row = 3;
}

$input_message = elgg_view('input/plaintext', array(
		'name' => 'wire_message',
		'value' => elgg_echo('missions:check_this_mission', array(elgg_get_excerpt($entity->job_title, elgg_get_plugin_setting('mission_job_title_card_cutoff', 'missions')/2), $entity->getURL())),
		'id' => 'mission-message-share-wire-message-text-input',
		'class' => 'mtm thewire-textarea form-control elgg-input-plaintext',
		'data-max-length' => $char_limit,
		'rows' => $rows
));
?>

<div class="col-sm-8">
	<label for="mission-message-share-wire-message-text-input"><?php elgg_echo('missions:create_wire_post'); ?></label>
	<?php echo $input_message; ?>
</div>
<div class="col-sm-8"> 
	<?php
		echo elgg_view('input/submit', array(
				'value' => elgg_echo('missions:post'),
				'class' => 'elgg-button btn btn-primary',
				'style' => 'float:right;',
				'id' => 'mission-message-share-wire-post-submission-button'
		)); 
		echo elgg_view('page/elements/one-click-restrictor', array('restricted_element_id' => 'mission-message-share-wire-post-submission-button'));
	?> 
</div>