<?php
namespace App\Form;
use Cake\Form\Form;
use Cake\Form\Schema;

class GGMainSlidersForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('website_id', 'integer')
				->addField('image', ['type' => 'string'])
				->addField('display', ['type' => 'string'])
				->addField('descriptions', ['type' => 'string'])
				->addField('tag_links', ['type' => 'string'])
				->addField('sort', 'integer')
				->addField('active', 'boolean');
	}

}