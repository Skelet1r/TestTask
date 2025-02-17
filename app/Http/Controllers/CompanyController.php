<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getCompanies()
    {
        return $this->companyService->getCompanies();
    }

    public function getCompany($id)
    {
        return $this->companyService->getCompany($id);
    }

    public function addCompany(Request $request)
    {
        return $this->companyService->addCompany($request);
    }

    public function updateCompany(Request $request, Company $company)
    {
        return $this->companyService->updateCompany($request, $company);
    }

    public function deleteCompany(Company $company)
    {
        return $this->companyService->deleteCompany($company);
    }

}
