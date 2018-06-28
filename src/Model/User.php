<?php

namespace Model;

class User extends \atk4\data\Model {
    public $table = 'users';

    function init() {
        parent::init();

        $this->addFields([
            ['name', 'required'=>true],
            ['email', 'required'=>true],
            ['password', 'required'=>true],
            ['is_confirmed', 'type'=>'boolean', 'system'=>true],
            ['is_admin', 'type'=>'boolean'],
        ]);
        
        $ref = $this->hasMany('Friends', new Friend());
        $ref->addField('total_loan', ['aggregate'=>'sum', 'type'=>'money']);
        $ref->addField('total_repaid', ['aggregate'=>'sum', 'type'=>'money']);

    }
}