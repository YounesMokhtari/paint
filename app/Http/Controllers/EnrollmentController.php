<?php

namespace App\Http\Controllers;

use App\Models\Courses\Course;
use App\Models\Enrollments\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        // بررسی عدم ثبت‌نام قبلی
        if ($course->students()->where('users.id', auth()->id())->exists()) {
            return back()->withErrors(['error' => __('courses.messages.already_enrolled')]);
        }

        try {
        // ایجاد ثبت‌نام
        $enrollment = new Enrollment([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'status' => Enrollment::STATUS_PENDING,
            'price_paid' => $course->price,
            'payment_id' => Str::random(10),
        ]);
        // dd($enrollment);
        $enrollment->save();

        // در اینجا کاربر به درگاه پرداخت هدایت می‌شود
        // $payment = $this->initiatePayment($enrollment);
        // return redirect($payment->url);

        // فعلاً برای تست، مستقیم تکمیل می‌کنیم
        $enrollment->update([
            'status' => Enrollment::STATUS_COMPLETED,
            'payment_id' => 'test_' . time(),
        ]);
        $course->students()->attach(auth()->id());
        return redirect()
            ->route('courses.show', $course)
            ->with('success', __('courses.messages.enrollment_successful'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => __('courses.messages.enrollment_failed')]);
        }
    }

    public function verify(Request $request, Course $course, Enrollment $enrollment)
    {
        try {
            // بررسی وضعیت پرداخت از درگاه
            // $payment = $this->verifyPayment($request->token);

            $enrollment->update([
                'status' => Enrollment::STATUS_COMPLETED,
                'payment_id' => $request->token,
            ]);

            return redirect()
                ->route('courses.show', $course)
                ->with('success', __('courses.messages.payment_successful'));
        } catch (\Exception $e) {
            $enrollment->update(['status' => Enrollment::STATUS_FAILED]);
            return redirect()
                ->route('courses.show', $course)
                ->withErrors(['error' => __('courses.messages.payment_failed')]);
        }
    }
}
