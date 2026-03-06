<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Put;

class TeacherController extends Controller
{
    #[Get('api/teachers')]
    public function index(): JsonResponse
    {
        return response()->json(
            TeacherResource::collection(Teacher::latest()->paginate(10))
        );
    }

    #[Get('api/teachers/{teacher}')]
    public function show(Teacher $teacher): JsonResponse
    {
        return response()->json(new TeacherResource($teacher));
    }

    #[Post('api/teachers')]
    public function store(StoreTeacherRequest $request): JsonResponse
    {
        $teacher = Teacher::create($request->validated());

        dd($teacher);

        return response()->json(
            new TeacherResource($teacher),
            201
        );
    }

    #[Put('api/teachers/{teacher}')]
    public function update(UpdateTeacherRequest $request, Teacher $teacher): JsonResponse
    {
        $teacher->update($request->validated());

        return response()->json(new TeacherResource($teacher));
    }

    #[Delete('api/teachers/{teacher}')]
    public function destroy(Teacher $teacher): JsonResponse
    {
        $teacher->delete();

        return response()->json([
            'message' => 'Teacher deleted successfully',
        ]);
    }
}
