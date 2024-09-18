<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class CheckForMaintenanceMode
{
    public function handle($request, Closure $next)
    {
        if ($this->appIsInMaintenanceMode()) {
            throw new MaintenanceModeException('Application is currently in maintenance mode.');
        }

        return $next($request);
    }

    protected function appIsInMaintenanceMode()
    {
        return file_exists(storage_path('framework/down'));
    }
}
