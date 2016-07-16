<?php

namespace App\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppMainBundle extends Bundle
{
    
    public function getParent()
    {
        return 'FOSUserBundle';
    }
    
    public function getParent2()
    {
        return 'FOSUserBundle';
    }
        
}
