<?php

namespace App\Services;

use DB;
use Exception;

class BaseService
{

    public function transaction($callable, $message = null)
    {
        try {
            return DB::transaction(function () use ($callable) {
                return $callable();
            });
        } catch (Exception $e) {
            new Exception($message ?? 'Server Error');
        }
    }
}
