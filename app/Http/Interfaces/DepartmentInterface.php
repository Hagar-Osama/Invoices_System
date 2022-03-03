<?php
namespace App\Http\Interfaces;

use App\Http\Requests\AddDepartmentRequest;
use Illuminate\Http\Request;

interface DepartmentInterface {

    public function index();

    public function store($request);

    public function update($request);

    public function delete( $request);
}
