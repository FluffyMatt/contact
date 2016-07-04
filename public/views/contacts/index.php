<?php
	// Load in contacts and favourites
	$contact = new App\Contact\ContactDirectory();
	$contacts = $contact->load();

	if ($_POST) {
		$contact->favouriteContact($_POST);
		header("Refresh:0");
	}

?>

<div class="ui grid">

	<div class="ui left floated five wide column">
		<h2>Contact List</h2>
		<?php
		foreach ($contacts['contacts'] as $key => $contact) {
			// Partial used for showing users
			include(getcwd().'/views/contacts/_contact.php');
		}

		?>

	</div>

	<div class="ui right floated grid five wide column">

		<h2>My Contacts</h2>
		<?php
		foreach ($contacts['favs'] as $key => $contact) {
			// Used to hide span
			$fav = true;
			// Partial used for showing users
			include(getcwd().'/views/contacts/_contact.php');
		}

		?>

	</div>

</div>
