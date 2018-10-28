<?php
// @param title
// @param items


$component = 'allEntries';
$options['javascript_data'] = compact('title', 'subtitle', 'newItemName', 'baseUri', 'items', 'component', 'titleKey', 'secondTitleKey');

require(__DIR__ . '/../../../JSDATA.php');
require(__DIR__ . '/../../react-app.php');
?>