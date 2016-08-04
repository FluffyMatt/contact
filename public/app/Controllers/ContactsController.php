<?php
// Global namespace for contact
namespace App\Controllers;

use App\Database\Mysql as Database;

class ContactsController
{

    // Private var for DB connection
    protected $_db;

	// Setting up the class for use
	function __construct()
	{
		$this->_db = new Database();
	}

    public function index($data) {
        if (!empty($data['post'])) {
            if ($this->_db->favourite($data['post'], 'contacts')) {
    			$this->_flash('positive', 'Save successfull', 'You successfully added a new contact');
                header("Location: http://contacts/");
                return true;
    		}

    		$this->_flash('negative', 'Save failed', 'Adding a new contact failed');
            header("Location: http://contacts/");
            return false;
        }
        return ['contacts' => $this->_db->all('contacts')->get(), 'favourites' => $this->_db->all('contacts')->where(['favourite' => 1])->get()];
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
	public function add($data)
	{
        if (!empty($data['post'])) {
    		// Check if the data was saved if so set success flash
    		if ($this->_db->save($data['post'], 'contacts')) {
    			$this->_flash('positive', 'Save successfull', 'You successfully added a new contact');
    			return true;
    		}

    		$this->_flash('negative', 'Save failed', 'Adding a new contact failed');

    		return false;
        }
	}

    public function json($data) {
        return ['contacts' => $this->_db->all('contacts')->get()];
    }

	// Set flash message for the save or unsuccessful saves
	private function _flash($type, $header, $message)
    {
		$_SESSION['message'] = [
			'type' => $type,
			'header' => $header,
			'message' => $message
		];
	}

}
