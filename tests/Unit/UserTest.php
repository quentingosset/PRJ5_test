<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
     public function testShowPresence(){
        $this->visit("/")
            ->select(1,"listeGroupe")
            ->select(1,"listeCourse")
            ->seePage("/presence");
     }


}
