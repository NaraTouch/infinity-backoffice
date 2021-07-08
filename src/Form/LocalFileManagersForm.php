<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class LocalFileManagersForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('group_id', 'integer')
				->addField('web_url', ['type' => 'string'])
				->addField('secret_key', ['type' => 'string'])
				->addField('active', 'boolean');
	}

}