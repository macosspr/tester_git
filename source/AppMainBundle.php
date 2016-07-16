<?php

namespace App\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppMainBundle extends Bundle
{
    
    public function getParent()
    {
        return 'FOSUserBundleAla';
    }
    
    public function getParent2()
    {
        return 'FOSUserBundle222 from snd';
    }
        
}
