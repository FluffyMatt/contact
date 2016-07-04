<?php
// Global namespace for contact added
namespace App\Contact;

class ContactDirectory {
	// Used to store the current contacts
	private $_contacts;
	// Used to store current favourites
	private $_favs;

	// Setting up the class for use
	function __construct()
	{
		$this->_contacts = json_decode(file_get_contents('./data/contacts.json'), true);
		$this->_favs = json_decode(file_get_contents('./data/favourites.json'), true);
	}

	public function load()
	{

		return ['contacts' => $this->_contacts, 'favs' => $this->_favs];
	}

	// Used as the global save should really be in a data model
	public function save($postData, $type, $data = [])
	{

		if ($type == 'contacts') {
			foreach ($this->_contacts as $key => $value) {
				$data[] = $value;
			}
			$data[] = $postData['contact'];

			if (file_put_contents('./data/contacts.json', json_encode($data, JSON_PRETTY_PRINT))) {
				return true;
			}
		} else if ($type == 'favs') {
			foreach ($this->_favs as $key => $value) {
				$data[] = $value;
			}
			$data[] = $postData['contact'];

			if (file_put_contents('./data/favourites.json', json_encode($data, JSON_PRETTY_PRINT))) {
				return true;
			}
		}

		return false;
	}

	// Used to find a contact
	public function search($postContact, $exact = [], $partial = [])
	{
		foreach ($this->_contacts as $key => $contact) {
			if (stristr($postContact, $contact['forename']) && stristr($postContact, $contact['surname'])) {
				$exact[] = $contact;
			} else if (stristr($postContact, $contact['forename']) || stristr($postContact, $contact['surname'])) {
				$partial[] = $contact;
			}
		}

		return array_merge($exact, $partial);
	}

	// Used to add a new contact
	public function addContact($data)
	{
		$data['contact']['address'] = implode(' ', $data['contact']['address']);
		session_start();
		if ($this->save($data, 'contacts')) {
			$_SESSION['message'] = [
				'type' => 'positive',
				'header' => 'Save successfull',
				'message' => 'You successfully added a new contact'
			];
			return true;
		}

		$_SESSION['message'] = [
			'type' => 'negative',
			'header' => 'Save failed',
			'message' => 'Adding a new contact failed'
		];

		return false;
	}

	// Used to add a contact to a users favourites
	public function favouriteContact($data)
	{
		session_start();
		if ($this->save($data, 'favs')) {
			$_SESSION['message'] = [
				'type' => 'positive',
				'header' => 'Favourite added',
				'message' => 'You successfully added a new favourite'
			];
			return true;
		}

		$_SESSION['message'] = [
			'type' => 'negative',
			'header' => 'Favourite failed',
			'message' => 'Adding a new favourite failed'
		];

		return false;
	}

	// Check to see if a contact is a favourite
	public function isFavourite($forename, $surname)
	{
		foreach ($this->_favs as $key => $contact) {
			if (stristr($forename, $contact['forename']) && stristr($surname, $contact['surname'])) {
				return true;
			}
		}
		return false;
	}

}
