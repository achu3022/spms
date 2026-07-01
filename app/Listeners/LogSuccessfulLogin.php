<?php

namespace App\Listeners;

use App\Services\AuditLogService;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    protected $auditService;

    public function __construct(AuditLogService $auditService)
    {
        $this->auditService = $auditService;
    }

    public function handle(Login $event): void
    {
        $user = $event->user;
        if ($user instanceof \App\Models\User) {
            $this->auditService->logLogin($user);
        }
    }
}
