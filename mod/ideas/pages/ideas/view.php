<?php
/**
 * View an idea
 *
 * @package ideas
 */

$idea = get_entity(get_input('guid'));

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "ideas/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "ideas/owner/$page_owner->username");
}

$title = $idea->title;

elgg_push_breadcrumb($title);


$content = elgg_view_entity($idea, array('full_view' => 'full'));
$status = get_idea_status(get_input('guid'));

if ( $status == 0 ){		// regular comments
	// make into agregate idea option
	$vars["parent-id"] = $idea->guid;
	$aggregatelink = elgg_view_form('ideas/aggregateideas', array(), $vars);

	// make into child idea / link to a parent option
	$vars["child-id"] = $idea->guid;
	$childlink =  elgg_view_form('ideas/linkidea', array(), $vars);

	$content .= $aggregatelink . $childlink . elgg_view_comments($idea);
}
else if ( $status == -1 ) {		// add link to parent idea, can not add comments
	$parent = elgg_get_entities_from_relationship( array( 'relationship' => 'child-idea') )[0];
	// unlink child button
	$url = elgg_add_action_tokens_to_url("action/ideas/unlink?guid1={$idea->guid}&guid2={$parent->guid}");
	$unlinklink = elgg_view('output/url', array(
			'href' => $url,
			'text' => "unlink",
			'is_trusted' => true,
			'class' => 'btn btn-primary'
		));

	$link = elgg_view('output/url', array(
			'href' => $parent->getURL(),
			'text' => $parent->title,
			'is_trusted' => true
		));
	$comments = elgg_view_comments($idea, false, array( 'show_add_form' =>  false ));

	$content .= $unlinklink . "<p>This idea is a child of the aggregated idea: $link </p>" . $comments;
}
else {		// add links to child ideas
	// re-aggregate
	$vars["parent-id"] = $idea->guid;
	$reagglink = elgg_view_form('ideas/aggregateideas', array(), $vars);

	// dissolve aggregation
	$url = elgg_add_action_tokens_to_url("action/ideas/dissolveaggregate?guid={$idea->guid}");
	$dissolvelink = elgg_view('output/url', array(
			'href' => $url,
			'text' => "dissolve aggregate",
			'is_trusted' => true,
			'class' => 'btn btn-primary'
		));

	$children = elgg_get_entities_from_relationship( array( 'relationship' => 'child-idea', 'inverse_relationship' => true ) );
	$links = "";		// linkts to the children
	foreach ( $children as $child ){
		$links .= "<div class='col-md-2'>" . elgg_view('output/url', array(
				'href' => $child->getURL(),
				'text' => $child->title,
				'is_trusted' => true
			)) . "</div>";
	}
	$comments = elgg_view_comments($idea);

	$content .= $reagglink . $dissolvelink . "This idea is an aggregated idea with $status child(ren): <div class='row'> $links </div>" . $comments;
}

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
	'sidebar' => '<h3 class="mbm">' . elgg_echo('ideas:same_group') . '</h3>' . elgg_view('ideas/sidebar')
));

echo elgg_view_page($title, $body);
