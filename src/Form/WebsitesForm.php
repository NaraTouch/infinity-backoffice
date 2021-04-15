<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class WebsitesForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('domain', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('code', ['type' => 'string'])
				->addField('active', 'boolean');
	}

}