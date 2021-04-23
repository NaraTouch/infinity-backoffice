<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class TemplatesForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('description', ['type' => 'string'])
				->addField('sort', 'integer')
				->addField('active', 'boolean');
	}

}