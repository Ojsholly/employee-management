<?php

namespace App\Services\Company;

use App\Mail\Company\AccountCreationNoticeMail;
use App\Models\Company;
use App\Services\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

class CompanyService extends Service
{
    /**
     * @param  array  $data
     * @return Company
     */
    public function createCompany(array $data): Company
    {
        $userData = collect($data)->only(['username', 'password'])->toArray();
        $user = $this->createUser($userData, 'company');

        $companyData = collect($data)->only(['name', 'email', 'website'])->toArray();

        $user->company()->create($companyData);

        if (! app()->environment('testing')) {
            Mail::to($user->company->email)->send(new AccountCreationNoticeMail($user->company));
        }

        return $user->company;
    }

    /**
     * @return mixed
     */
    public function getCompanies(): mixed
    {
        return Company::paginate(10);
    }

    /**
     * @param  string  $uuid
     * @param  array  $relationships
     * @return mixed
     *
     * @throws Throwable
     */
    public function getCompany(string $uuid, array $relationships = []): mixed
    {
        $company = Company::findByUuid($uuid);

        throw_if(! $company, new ModelNotFoundException('Requested company not found.', ResponseAlias::HTTP_NOT_FOUND));

        return $company;
    }

    /**
     * @param  array  $data
     * @param  string  $uuid
     * @return Company
     *
     * @throws Throwable
     */
    public function updateCompany(array $data, string $uuid): Company
    {
        $company = $this->getCompany($uuid);

        $userData = collect($data)->only('username')->toArray();
        $company->user()->update($userData);

        $companyData = collect($data)->only(['name', 'email', 'website'])->toArray();
        $company->update($companyData);

        return $company;
    }

    /**
     * @param  string  $uuid
     * @return bool
     *
     * @throws Throwable
     */
    public function deleteCompany(string $uuid): bool
    {
        $company = $this->getCompany($uuid);

        return $company->delete();
    }
}
