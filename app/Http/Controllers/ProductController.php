<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\product\ProductStoreRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return DataTables::of($products)
            ->addColumn('name', function ($product) {
                return $product->name;
            })->addColumn('quantity', function ($product) {
                return $product->quantity??'';
            })->addColumn('company_id', function ($product) {
                return $product->company->name??'--';
            })
            ->addColumn('action', function ($company) {
                return '<span class="action-product-delete btn btn-link btn-sm text-danger btn-sm" data-toggle="modal" data-target="#company-delete-modal" data-name="' . $company->name . '" data-id="' . $company->id . '"><i class="far fa-trash-alt"></i> Delete</span>'
                    . '<span class="action-product-edit btn btn-link btn-sm text-dark" data-id="' . $company->id . '" data-target="#edit-product-modal"><i class="far fa-edit"></i> Edit</span>';
            })
            ->rawColumns(['name', 'quantity', 'company_id', 'action'])
            ->make(true);
    }


    public function product()
    {
        $companies = Company::all();
        return view('product.index', ['companies' => $companies]);
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::create($request->all());
            DB::commit();
            return response()->json(['message' => $product->name . ' Created successfully']);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $product->name . ' Created successfully']);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::whereId($id)->firstOrFail();
            DB::commit();
            return response()->json(['product' => $product]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::whereId($id)->firstOrFail();
            $product->delete();
            DB::commit();
            return response()->json(['message' => $product->name . " Deleted Successfully"]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }

    }

    public function update(ProductUpdateRequest $request ,$id)
    {

        try {
            DB::beginTransaction();
            $product = Product::whereId($id)->firstOrFail();
            $product->update($request->all());
            DB::commit();
            return response()->json(['message' => $product->name ." Updated Successfully"]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }
    }

    public function companyProducts(Request $request , $id)
    {
        try {
            DB::beginTransaction();
            $company = Company::whereId($id)->firstOrFail();
            $products = $company->products()->get();
            DB::commit();
            return response()->json(['products' => $products]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()]);
        }
    }
}
