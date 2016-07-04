<?php

	$contact = new App\Contact\ContactDirectory();
	$results = $contact->search($request['get']['lookup']);

?>

<div class="ui dividing header">
	<h2>Found <?php echo count($results) ?> contacts</h2>
</div>

<div class="ui grid">

	<div class="ui left floated five wide column">
		<?php

		foreach ($results as $key => $contact) {

			include(getcwd().'/views/contacts/_contact.php');

		}

		?>


	</div>

</div>
