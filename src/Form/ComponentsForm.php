<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class ComponentsForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('template_id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('table_name', ['type' => 'string'])
				->addField('description', ['type' => 'string'])
				->addField('script', ['type' => 'string'])
				->addField('sort', 'integer')
				->addField('active', 'boolean');
	}

}