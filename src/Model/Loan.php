<?php

namespace Model;

class Loan extends \atk4\data\Model {
    public $table = 'loans';
    function init() {
        parent::init();

        $this->addFields([
            ['date', 'required'=>true, 'type'=>'date'],
            ['amount', 'required'=>true, 'type'=>'money', ['icon'=>'dollar sign']],
        ]);
        $this->hasOne('friends_id', new Friend());
    }
}