<?php

class App extends \atk4\ui\App {
    function __construct($is_admin = false) {
        parent::__construct('Money Lending App');

        // set DB
        $this->dbConnect(isset($_ENV['CLEARDB_DATABASE_URL']) ? $_ENV['CLEARDB_DATABASE_URL'] : 'mysql://root:@localhost/money-lending');

        // Depending on the use, select appropriate layout
        if ($is_admin) {
            $this->initLayout('Admin');
            $this->layout->menuLeft->addItem(['Back', 'icon'=>'dashboard'],['index']);
            $this->layout->menuLeft->addItem(['Admin', 'icon'=>'cogs'],['admin']);

            // authentication validation
            $this->add(new \atk4\login\Auth())->setModel(new Model\Admin($this->db));
        } else {
            $this->initLayout('Centered');
            $this->auth = $this->add(new \atk4\login\Auth([
                'check' => false
            ]));
            $this->auth->setModel(new Model\User($this->db));
        }
       
    }
}
?>