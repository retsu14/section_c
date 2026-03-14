<?php 

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController 
{
    public function __construct(
        private StudentService $students
    ){}

    public function show(){
        return $this->students->get();
    }

    public function create(Request $request){
        $data = $request->only(['name', 'age', 'address']);

        return $this->students->create($data);
    }

    public function delete($id){
        return $this->students->delete($id);
    }

    // update to do
}