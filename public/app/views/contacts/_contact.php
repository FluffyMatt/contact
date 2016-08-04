<div class="ui card">
	<div class="content">
		<div class="header"> <?php echo $contact['forename'].' '.$contact['surname'] ?></div>
		<p><b>Email</b>:<br /> <a href="<?php echo 'mailto:'.$contact['email'] ?>"><?php echo $contact['email'] ?></a></p>
		<p><b>Address</b>:<br /> <?php echo $contact['house_name_number']." ".$contact['street_line_1']." ".$contact['street_line_2']."<br>".$contact['city']."<br>".$contact['region'] ?></p>
		<p><b>Telephone</b>:<br /> <a href="<?php echo 'tel:'.$contact['telephone'] ?>"><?php echo $contact['telephone'] ?></a></p>
	</div>
	<?php if (isset($fav) == false) { ?>
	<div class="extra content">
		<span class="right floated star">
			<i class="star <?php echo $contact['favourite'] ? 'active' : '' ?> icon"></i> <?php echo $contact['favourite'] ? 'Remove favourite' : 'Favourite' ?>
			<form class="contact-fav" action="/" method="post" class="hide">
				<input type="number" name="contacts[id]" value="<?php echo $contact['id'] ?>">
			</form>
		</span>
	</div>
	<?php } ?>
</div>
