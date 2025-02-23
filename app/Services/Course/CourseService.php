<?php

namespace App\Services\Course;

use App\Models\Courses\Course;
use App\Services\BaseService;

class CourseService extends BaseService
{


    public function store(mixed $data)
    {
        return $this->transaction(fn() => Course::create($data));
    }

    public function update(Course $course, mixed $data)
    {
        return $course->update($data);
    }

    public function destroy(Course $course)
    {
        return $course->delete();
    }
}
