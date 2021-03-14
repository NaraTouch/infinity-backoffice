<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class RolesForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('group_id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('active', 'boolean');
	}

}