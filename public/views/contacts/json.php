<?php

// Page used for searching contact and showing json

$contact = new App\Contact\ContactDirectory();
$contacts = $contact->search($_POST['name']);

	$data = [];

	foreach ($contacts as $key => $contact) {
		$data['results'][] = ['title' => $contact['forename'].' '.$contact['surname']];
	}

	echo json_encode($data, JSON_PRETTY_PRINT);

?>
