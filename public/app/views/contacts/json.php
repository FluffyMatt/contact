<?php

	foreach ($contacts as $key => $contact) {
		$data['results'][] = ['title' => $contact['forename'].' '.$contact['surname']];
	}

	echo json_encode($data, JSON_PRETTY_PRINT);

?>
