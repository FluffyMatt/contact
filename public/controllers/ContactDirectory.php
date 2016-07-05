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
		$postContact = strstr($postContact, '+') ? str_replace('+', ' ', $postContact) : $postContact;

		foreach ($this->_contacts as $key => $contact) {
			if (stristr($contact['forename'], $postContact) && stristr($contact['surname'], $postContact)) {
				$exact[] = $contact;
			} else if (stristr($contact['forename'].' '.$contact['surname'], $postContact)) {
				$exact[] = $contact;
			} else if (stristr($contact['forename'], $postContact) || stristr($contact['surname'], $postContact)) {
				$partial[] = $contact;
			}
		}

		return array_merge($exact, $partial);
	}

	// Used to add a new contact
	public function addContact($data)
	{
		// Implodes the address to match the one line approach in the json
		$data['contact']['address'] = implode(' ', $data['contact']['address']);
		// Check if the data was saved if so set success flash
		if ($this->save($data, 'contacts')) {
			$this->_flash('positive', 'Save successfull', 'You successfully added a new contact');
			return true;
		}

		$this->_flash('negative', 'Save failed', 'Adding a new contact failed');

		return false;
	}

	// Used to add a contact to a users favourites
	public function favouriteContact($data)
	{

		if ($this->save($data, 'favs')) {
			$this->_flash('negative', 'Favourite added', 'You successfully added a new favourite');
			return true;
		}

		$this->_flash('positive', 'Favourite failed', 'Adding a new favourite failed');

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

	// Set flash message for the save or unsuccessful saves
	private function _flash($type, $header, $message) {
		session_start();
		$_SESSION['message'] = [
			'type' => $type,
			'header' => $header,
			'message' => $message
		];
	}

}
