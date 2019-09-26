<?php

namespace Tests\Unit;

use App\Models\student;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function addStudentTest(){
        $temp = student::addStudent(1,"nomTest","prenomTest",475874);
        $this->assertTrue($temp);
       }

     /** @test */
     public function listingStudent(){
        $user = factory(Student::class)->create();
        $temp = student::listingStudent(1);
        $this->assertTrue($temp);
     }

    
}
