<?php

namespace App\Services;

use App\Repositories\StudentRepository;

class StudentService 
{
    // DEPENDENCY INJECTION
    public function __construct(
        private StudentRepository $studentRepository
    ) {}


    
}
