<?php

namespace Uni\AdminGeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UniAdminGeneratorBundle extends Bundle
{
    public function getParent()
    {
        return 'SensioGeneratorBundle';
    }
}
