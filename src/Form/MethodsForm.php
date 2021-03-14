<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class MethodsForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('module_id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('symbol', ['type' => 'string'])
				->addField('sort', 'integer')
				->addField('is_menu', 'boolean')
				->addField('active', 'boolean');
	}

}