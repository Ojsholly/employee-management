<?php

namespace App\Services\Employee;

use App\Models\Employee;
use App\Services\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class EmployeeService extends Service
{
    /**
     * @param string $companyUuid
     * @return LengthAwarePaginator
     */
    public function getEmployeesByCompany(string $companyUuid): LengthAwarePaginator
    {
        return Employee::where('company_id', $companyUuid)->paginate(10);
    }

    /**
     * @param $uuid
     * @return mixed
     * @throws Throwable
     */
    public function getEmployee($uuid): mixed
    {
        $employee = Employee::findByUuid($uuid);

        throw_if(!$employee, new ModelNotFoundException("Requested employee not found.", ResponseAlias::HTTP_NOT_FOUND));

        return $employee;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createEmployee(array $data): mixed
    {
        $userData = collect($data)->only(['username'])->toArray();

        $user = $this->createUser($userData, 'employee');

        $employeeData = collect($data)->only(['first_name', 'last_name', 'email', 'phone'])->toArray();

        $user->employee()->create($employeeData);

        return $user->employee;
    }
}
