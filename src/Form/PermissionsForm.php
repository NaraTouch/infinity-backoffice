<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class PermissionsForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('role_id', 'integer')
				->addField('method_id', 'integer');
	}

}