<?php

namespace App\Repositories;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface EnquiryRepositoryInterface
{
    public function all(): Collection;
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?Enquiry;
    public function findByPhone(string $phone): ?Enquiry;
    public function create(array $data): Enquiry;
    public function update(Enquiry $enquiry, array $data): bool;
    public function delete(Enquiry $enquiry): bool;
    public function globalSearch(string $query): Collection;
}
