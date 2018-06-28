<?php

namespace Model;

class Admin extends User {
    public $table = 'users';

    function init() {
        parent::init();

        $this->addCondition('is_admin', true);
    }
}