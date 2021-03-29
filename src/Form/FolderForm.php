<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class FolderForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('name', ['type' => 'string']);
	}

}