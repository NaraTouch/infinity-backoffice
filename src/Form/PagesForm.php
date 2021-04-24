<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class PagesForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('website_id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('tag_links', ['type' => 'string'])
				->addField('icon', ['type' => 'string'])
				->addField('code', ['type' => 'string'])
				->addField('sort', 'integer')
				->addField('active', 'boolean');
	}

}