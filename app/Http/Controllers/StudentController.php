<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        private StudentService $student
    ) {}

    public function create(Request $request): ?Students
    {
        $data = $request->only(['firstname', 'lastname', 'address', 'email']);

        return $this->student->create($data);
    }
}
