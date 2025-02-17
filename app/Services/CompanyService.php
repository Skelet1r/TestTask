<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyService
{
    public function getCompanies()
    {
        $result = Company::all();

        return response()->json([
            'companies' => $result
        ]);
    }

    public function getCompany($id)
    {
        $result = Company::findOrFail($id);

        return response()->json([
            'company' => $result
        ]);
    }

    public function addCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'address' => 'required|string',
            'logo' => 'required|string',
        ]);

        Company::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'logo' => $request->get('logo'),
        ]);

        return response()->json([
            'message' => 'Company created!'
        ]);
    }

    public function updateCompany(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'address' => 'required|string',
            'logo' => 'required|string',
        ]);

        $company->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'logo' => $request->get('logo'),
        ]);

        return response()->json([
            'message' => 'Company updated!'
        ]);
    }

    public function deleteCompany(Company $company)
    {
        $company->delete();

        return response()->json([
            'message' => 'Company deleted!'
        ]);
    }

}

