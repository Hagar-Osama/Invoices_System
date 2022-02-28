<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\ProductsInterface;
use App\Http\Traits\DepartmentTrait;
use App\Http\Traits\ProductTrait;
use App\Models\Department;
use App\Models\Product;

class ProductsRepository implements ProductsInterface
{
    use ProductTrait;
    use DepartmentTrait;
    private $productModel;
    private $depModel;

    public function __construct(Product $products, Department $department)
    {
        $this->productModel = $products;
        $this->depModel = $department;

    }

    public function index()
    {
        $products = $this->getAllProducts();
        $departments = $this->getAllDepartments();
        return view('products.products', compact('products', 'departments'));
    }

    public function store($request)
    {
        $this->productModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'department_id' => $request->department_id
        ]);
        return redirect(route('products.index'))->with('success', 'Product Has Been Added Successfully');

    }

    public function update($request)
    {
        $product = $this->getProductById($request->product_id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'department_id' => $request->department_id
        ]);
        return redirect(route('products.index'))->with('success', 'Product Has Been Updated Successfully');

    }

    public function destroy($request)
    {
        $product = $this->getProductById($request->product_id);
        $product->delete();
        return redirect(route('products.index'))->with('success', 'Product Has Been Deleted Successfully');

    }

}
