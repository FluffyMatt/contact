<?php
	if ($_POST) {
		$contact = new App\Contact\ContactDirectory();
		$saved = $contact->addContact($_POST);
		header("Refresh:0");
	}
?>

<div class="ui dividing header">
	<h2>Add a contact</h2>
</div>

<div class="ui grid">

	<div class="ui sixteen wide column">

		<form class="ui sixteen wide form" action="/contacts/add" method="post">

			<div class="fields">

				<div class="twelve wide field">
					<label for="contact[forename]">Forename</label>
					<input type="text" name="contact[forename]" placeholder="Bob">
				</div>

				<div class="twelve wide field">
					<label for="contact[surname]">Surname</label>
					<input type="text" name="contact[surname]" placeholder="Smith">
				</div>

				<div class="twelve wide field">
					<label for="contact[email]">Email</label>
					<input type="email" name="contact[email]" placeholder="user@example.net">
				</div>

				<div class="twelve wide field">
					<label for="contact[telephone]">Telephone Number</label>
					<input type="number" name="contact[telephone]" placeholder="01543 567463">
				</div>

			</div>

			<div class="fields">

				<div class="four wide field">
					<label for="contact[address]['number']">House Number</label>
					<input type="number" name="contact[address]['number']" placeholder="2">
				</div>

				<div class="six wide field">
					<label for="contact[address]['street1']">Street 1</label>
					<input type="text" name="contact[address]['street1']" placeholder="High Street">
				</div>

				<div class="six wide field">
					<label for="contact[address]['street2']">Street 2</label>
					<input type="text" name="contact[address]['street2']" placeholder="The Town">
				</div>

				<div class="six wide field">
					<label for="contact[address]['city']">City</label>
					<input type="text" name="contact[address]['city']" placeholder="Sidcup">
				</div>

				<div class="six wide field">
					<label for="contact[address]['region']">Region</label>
					<input type="text" name="contact[address]['region']" placeholder="Sidcup">
				</div>

			</div>

			<button class="ui right floated button primary">Save</button>

		</form>

	</div>

</div>
