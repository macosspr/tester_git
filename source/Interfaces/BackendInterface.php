<?php
namespace App\MainBundle\Interfaces;

interface BackendInterface
{
    public function tester1() {
        
    }
    
    public function tester2() {
        $i = -10;
        while($i < 0) {
            $i++;
        }
        
        echo $i;
    }
}
