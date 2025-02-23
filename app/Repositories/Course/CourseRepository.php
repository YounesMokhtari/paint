<?php

namespace App\Repositories\Course;

use App\Models\Courses\Course;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseRepository extends BaseRepository
{
    public function paginate(): LengthAwarePaginator
    {
        $courses = Course::query()->paginate();
        // dd($courses);
        return $courses;
    }
}
