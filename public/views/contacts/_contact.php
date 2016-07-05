<?php

	$contactDirectory = new App\Contact\ContactDirectory();
	$favourite = $contactDirectory->isFavourite($contact['forename'], $contact['surname']);
?>

<div class="ui card">
	<div class="content">
		<div class="header"> <?php echo $contact['forename'].' '.$contact['surname'] ?></div>
		<p>Email: <a href="<?php echo 'mailto:'.$contact['email'] ?>"><?php echo $contact['email'] ?></a></p>
		<p>Address: <?php echo $contact['address'] ?></p>
		<p>Telephone: <a href="<?php echo 'tel:'.$contact['telephone'] ?>"><?php echo $contact['telephone'] ?></a></p>
	</div>
	<?php if (!$fav) { ?>
	<div class="extra content">
		<span class="right floated star">
			<i class="star <?php echo $favourite ? 'active' : '' ?> icon"></i> <?php echo $favourite ? 'Is favourite' : 'Favourite' ?>
			<form class="contact-fav" action="/" method="post" class="hide">
				<input type="text" name="contact[forename]" value="<?php echo $contact['forename'] ?>">
				<input type="text" name="contact[surname]"value="<?php echo $contact['surname'] ?>">
				<input type="email" name="contact[email]" value="<?php echo $contact['email'] ?>">
				<input type="text" name="contact[address]" value="<?php echo $contact['address'] ?>">
				<input type="text" name="contact[telephone]" value="<?php echo $contact['telephone'] ?>">
			</form>
		</span>
	</div>
	<?php } ?>
</div>
