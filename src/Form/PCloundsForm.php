<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class PCloundsForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('email', ['type' => 'string'])
				->addField('password', ['type' => 'string'])
				->addField('active', 'boolean')
				->addField('website_id', 'integer');
	}

}