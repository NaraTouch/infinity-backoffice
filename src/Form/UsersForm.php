<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class UsersForm extends Form
{
	protected function _buildSchema(Schema $schema): Schema
	{
		return $schema
				->addField('id', 'integer')
				->addField('group_id', 'integer')
				->addField('name', ['type' => 'string'])
				->addField('email', ['type' => 'string'])
				->addField('active', 'boolean');
	}

//    public function validationDefault(Validator $validator): Validator
//    {
//        $validator->minLength('name', 10)
//            ->email('email');
//
//        return $validator;
//    }
//
//    protected function _execute(array $data): bool
//    {
//        // Send an email.
//        return true;
//    }
}