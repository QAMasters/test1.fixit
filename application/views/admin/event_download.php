<?php

include 'ICS.php';

header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=invite.ics');

$properties = array(
    'dtstart' => 'now',
    'dtend' => 'now + 30 minutes'
);

$ics = new ICS($properties);

echo $ics->to_string();

?>