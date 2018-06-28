<?php

namespace Model;

class Repayment extends \atk4\data\Model {
    public $table = 'repayment';
    function init() {
        parent::init();

        $this->addFields([
            ['date', 'required'=>true, 'type'=>'date'],
            ['amount', 'required'=>true, 'type'=>'money', ['icon'=>'dollar sign']],
        ]);
        $this->hasOne('friends_id', new Friend());
    }
}