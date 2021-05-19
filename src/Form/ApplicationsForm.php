<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class ApplicationsForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('template_id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('script', ['type' => 'string'])
				->addField('layout', ['type' => 'string'])
				->addField('menu', ['type' => 'string'])
				->addField('active', 'boolean');
	}

}