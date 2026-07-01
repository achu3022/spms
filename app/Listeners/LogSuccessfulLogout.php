<?php

namespace App\Listeners;

use App\Services\AuditLogService;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    protected $auditService;

    public function __construct(AuditLogService $auditService)
    {
        $this->auditService = $auditService;
    }

    public function handle(Logout $event): void
    {
        $user = $event->user;
        if ($user instanceof \App\Models\User) {
            $this->auditService->logLogout($user);
        }
    }
}
