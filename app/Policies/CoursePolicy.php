<?php

namespace App\Policies;

use App\Models\Courses\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any courses.
     */
    public function viewAny(?User $user): bool
    {

        return true; // همه می‌توانند لیست دوره‌ها را ببینند
    }

    /**
     * Determine whether the user can view the course.
     */
    public function view(?User $user, Course $course): bool
    {
        return true; // همه می‌توانند جزئیات دوره را ببینند
    }

    /**
     * Determine whether the user can create courses.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the course.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->creator_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the course.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->creator_id || $user->isAdmin();
    }
}
