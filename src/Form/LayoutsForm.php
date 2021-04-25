<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class LayoutsForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('subpage_id', 'integer')
				->addField('component_id', 'integer')
				->addField('sort', 'integer')
				->addField('active', 'boolean');
	}

}