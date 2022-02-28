<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductsInterface;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productInterface;
    public function __construct(ProductsInterface $products)
    {
        $this->productInterface = $products;

    }

    public function index()
    {
        return $this->productInterface->index();
    }

    public function store(AddProductRequest $request)
    {
        return $this->productInterface->store($request);
    }

    public function update(UpdateProductRequest $request)
    {
        return $this->productInterface->update($request);
    }

    public function destroy(DeleteProductRequest $request)
    {
        return $this->productInterface->destroy($request);
    }

}
