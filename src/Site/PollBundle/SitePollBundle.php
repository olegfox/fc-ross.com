<?php

namespace Site\PollBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SitePollBundle extends Bundle
{
    public function getParent()
    {
        return 'PrismPollBundle';
    }
}
