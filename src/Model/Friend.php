<?php

namespace Model;

class Friend extends \atk4\data\Model {
    public $table = 'friends';
    function init() {
        parent::init();

        $this->addFields([
            ['first_name', 'required'=>true],
            ['last_name', 'required'=>true],
            ['email', 'required'=>true],
        ]);
        $this->hasOne('users_id', new User());
        
        $ref = $this->hasMany('Loans', new Loan());
        $ref->addField('total_loan', ['aggregate'=>'sum', 'field'=>'amount', 'type'=>'money']);

        $ref = $this->hasMany('Repayments', new Repayment());
        $ref->addField('total_repaid', ['aggregate'=>'sum', 'field'=>'amount', 'type'=>'money']);

        $this->addExpression('owed', ['[total_loan] - [total_repaid]', 'type'=>'money']);
    }
}