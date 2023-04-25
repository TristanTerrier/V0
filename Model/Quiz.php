<?php

namespace Phppot;

class Quiz
{

    private $ds;

    function __construct()
    {
        require_once '../lib/DataSource.php';
        $this->ds = new DataSource();
    }
}
