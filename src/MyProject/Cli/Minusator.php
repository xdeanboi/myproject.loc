<?php

namespace MyProject\Cli;

class Minusator extends AbstractCommand
{
    public function execute()
    {
        echo $this->getParam('x') - $this->getParam('y');
    }

    protected function checkParams()
    {
        $this->ensureParamExists('x');
        $this->ensureParamExists('y');
    }
}