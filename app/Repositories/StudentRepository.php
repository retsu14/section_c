<?php

namespace App\Repositories;

use App\Models\Students;

class StudentRepository
{
    // get all students
    public function getStudents()
    {
        return Students::all();
    }

    //   create student
    public function createStudent($data)
    {
        // eloquent ORM
        return Students::create($data);
    }

    //    delete this student
    public function deleteStudent($id)
    {
        $student = Students::findOrFail($id);

        return $student->delete();
    }

    // update student - to do
}
