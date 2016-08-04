<div class="ui dividing header">
	<h2>Add a contact</h2>
</div>

<div class="ui grid">

	<div class="ui sixteen wide column">

		<form class="ui sixteen wide form" action="/contacts/add" method="post">

			<div class="fields">

				<div class="twelve wide field">
					<label for="contacts[forename]">Forename</label>
					<input type="text" name="contacts[forename]" placeholder="Bob">
				</div>

				<div class="twelve wide field">
					<label for="contacts[surname]">Surname</label>
					<input type="text" name="contacts[surname]" placeholder="Smith">
				</div>

				<div class="twelve wide field">
					<label for="contacts[email]">Email</label>
					<input type="email" name="contacts[email]" placeholder="user@example.net">
				</div>

				<div class="twelve wide field">
					<label for="contacts[telephone]">Telephone Number</label>
					<input type="number" name="contacts[telephone]" placeholder="01543 567463">
				</div>

			</div>

			<div class="fields">

				<div class="four wide field">
					<label for="contacts[house_name_number]">House Number</label>
					<input type="number" name="contacts[house_name_number]" placeholder="2">
				</div>

				<div class="six wide field">
					<label for="contacts[street_line_1]">Street 1</label>
					<input type="text" name="contacts[street_line_1]" placeholder="High Street">
				</div>

				<div class="six wide field">
					<label for="contacts[street_line_2]">Street 2</label>
					<input type="text" name="contacts[street_line_2]" placeholder="The Town">
				</div>

				<div class="six wide field">
					<label for="contacts[city]">City</label>
					<input type="text" name="contacts[city]" placeholder="Sidcup">
				</div>

				<div class="six wide field">
					<label for="contacts[region]">Region</label>
					<input type="text" name="contacts[region]" placeholder="Sidcup">
				</div>

			</div>

			<button class="ui right floated button primary">Save</button>

		</form>

	</div>

</div>
