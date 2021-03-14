<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class ModulesForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('symbol', ['type' => 'string'])
				->addField('sort', 'integer')
				->addField('active', 'boolean');
	}

}