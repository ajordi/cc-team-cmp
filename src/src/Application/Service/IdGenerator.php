<?php

namespace App\Application\Service;

interface IdGenerator
{
    /**
     * @return mixed
     */
    public function next();
}
