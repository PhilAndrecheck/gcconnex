<?php

$group = elgg_extract("entity", $vars);

echo "<div id='group-tools-related-groups-form'>";
echo "<div class='elgg-subtext mrgn-bttm-sm'>" . elgg_echo("group_tools:related_groups:form:description") . "</div>";
echo elgg_view("input/autocomplete", array("name" => "guid", 'class' => 'pull-left', "match_on" => "groups", "placeholder" => elgg_echo("group_tools:related_groups:form:placeholder")));
echo elgg_view("input/hidden", array("name" => "group_guid", "value" => $group->getGUID(),)); //NP added ->getGUID() so form can know what the guid is :3
echo elgg_view("input/submit", array("value" => elgg_echo("add"), 'class' => 'mrgn-lft-sm btn-primary'));

echo "</div>";
