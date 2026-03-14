<?php

namespace App\Services;

use App\Repositories\StudentRepository;

class StudentService 
{
    // DEPENDENCY INJECTION
    public function __construct(
        private StudentRepository $studentRepository
    ) {}

    // get all students
    public function get()
    {
        return $this->studentRepository->getStudents();
    }
    
    // create student
    public function create(array $data)
    {
        return $this->studentRepository->createStudent($data);
    }

    // delete student
    public function delete($id)
    {
        return $this->studentRepository->deleteStudent($id);
    }
}
