<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\company\CompanyStoreRequest;
use App\Http\Requests\company\CompanyUpdateRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all();
        return DataTables::of($companies)
            ->addColumn('name', function ($company) {
                return $company->name;
            })
            ->addColumn('action', function ($company) {
                return '<span class="action-company-delete btn btn-link btn-sm text-danger btn-sm" data-toggle="modal" data-target="#company-delete-modal" data-name="' . $company->name . '" data-id="' . $company->id . '"><i class="far fa-trash-alt"></i> Delete</span>'
                    .'<span class="action-company-edit btn btn-link btn-sm text-dark" data-id="' . $company->id . '" data-target="#edit-company-modal"><i class="far fa-edit"></i> Edit</span>';
            })
            ->rawColumns(['name', 'action'])
            ->make(true);

    }

    public function store(CompanyStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $company = Company::create($request->all());
            DB::commit();
            return response()->json(['message' => $company->name . ' Created successfully']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }

    }

    public function companies()
    {
        return view('company.index');
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $company = Company::whereId($id)->firstOrFail();
            $company->delete();
            DB::commit();
            return response()->json(['message' => $company->name . " Deleted Successfully"]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }

    }

    public function edit(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $company = Company::whereId($id)->firstOrFail();
            DB::commit();
            return response()->json(['company' => $company]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function update(CompanyUpdateRequest $request ,$id)
    {

        try {
            DB::beginTransaction();
            $company = Company::whereId($id)->firstOrFail();
            $company->update($request->all());
            DB::commit();
            return response()->json(['message' => $company->name ." Updated Successfully"]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function allCompanies()
    {
        try {
            DB::beginTransaction();
            $company = Company::all();
            DB::commit();
            return response()->json(['company' => $company],200);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage(),402]);
        }
    }

}
