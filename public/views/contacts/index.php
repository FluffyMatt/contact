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

	<div class="ui left floated eleven wide column">
		<h2 class="ui dividing header">Contact List</h2>
		<div class="ui cards">
			<?php
			if (!empty($contacts['favs'])) {

				foreach ($contacts['contacts'] as $key => $contact) {
					// Partial used for showing users
						include(getcwd().'/views/contacts/_contact.php');
				}

			}
			?>
		</div>

	</div>

	<div class="ui right floated grid five wide column">

		<h2>My Contacts</h2>
		<?php
		if (!empty($contacts['favs'])) {

			foreach ($contacts['favs'] as $key => $contact) {
				// Used to hide span
				$fav = true;
				// Partial used for showing users
				include(getcwd().'/views/contacts/_contact.php');
			}

		}

		?>

	</div>

</div>
