<?php

namespace App\Repositories;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EnquiryRepository implements EnquiryRepositoryInterface
{
    public function all(): Collection
    {
        return Enquiry::with(['branch', 'course', 'leadSource', 'assignedEmployee', 'assignedTeam'])->get();
    }

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = Enquiry::with(['branch', 'course', 'leadSource', 'assignedEmployee', 'assignedTeam', 'district', 'state'])
            ->orderBy('updated_at', 'desc');

        if (!empty($filters['branch_id'])) {
            $query->where('branch_id', $filters['branch_id']);
        }
        if (!empty($filters['course_id'])) {
            $query->where('course_id', $filters['course_id']);
        }
        if (!empty($filters['lead_source_id'])) {
            $query->where('lead_source_id', $filters['lead_source_id']);
        }
        if (!empty($filters['state_id'])) {
            $query->where('state_id', $filters['state_id']);
        }
        if (!empty($filters['district_id'])) {
            $query->where('district_id', $filters['district_id']);
        }
        if (!empty($filters['assigned_employee_id'])) {
            $query->where('assigned_employee_id', $filters['assigned_employee_id']);
        }
        if (!empty($filters['assigned_team_id'])) {
            $query->where('assigned_team_id', $filters['assigned_team_id']);
        }
        if (!empty($filters['current_status'])) {
            $query->where('current_status', $filters['current_status']);
        }
        if (!empty($filters['date_preset'])) {
            $this->applyDatePreset($query, $filters['date_preset'], $filters['start_date'] ?? null, $filters['end_date'] ?? null);
        }

        return $query->paginate($perPage);
    }

    public function findById(int $id): ?Enquiry
    {
        return Enquiry::with(['branch', 'course', 'leadSource', 'assignedEmployee', 'assignedTeam', 'district', 'state', 'activities.employee', 'followUps.employee', 'payments.employee'])
            ->find($id);
    }

    public function findByPhone(string $phone): ?Enquiry
    {
        return Enquiry::where('phone_number', $phone)->first();
    }

    public function create(array $data): Enquiry
    {
        return Enquiry::create($data);
    }

    public function update(Enquiry $enquiry, array $data): bool
    {
        return $enquiry->update($data);
    }

    public function delete(Enquiry $enquiry): bool
    {
        return $enquiry->delete();
    }

    public function globalSearch(string $search): Collection
    {
        return Enquiry::with(['branch', 'course', 'assignedEmployee', 'assignedTeam'])
            ->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('enquiry_number', 'like', "%{$search}%")
                  ->orWhere('place', 'like', "%{$search}%")
                  ->orWhereHas('course', function ($c) use ($search) {
                      $c->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('assignedEmployee', function ($e) use ($search) {
                      $e->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('assignedTeam', function ($t) use ($search) {
                      $t->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('district', function ($d) use ($search) {
                      $d->where('name', 'like', "%{$search}%");
                  });
            })
            ->limit(20)
            ->get();
    }

    protected function applyDatePreset($query, string $preset, ?string $start = null, ?string $end = null): void
    {
        switch ($preset) {
            case 'today':
                $query->whereDate('created_at', now()->toDateString());
                break;
            case 'yesterday':
                $query->whereDate('created_at', now()->subDay()->toDateString());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
            case 'custom':
                if ($start && $end) {
                    $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
                }
                break;
        }
    }
}
