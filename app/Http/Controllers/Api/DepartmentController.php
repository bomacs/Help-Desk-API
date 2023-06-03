<?php

namespace App\Http\Controllers\Api;

use App\Traits;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Http\Resources\DepartmentResource;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Traits\HttpResponses;

class DepartmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepartmentResource::collection(Department::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        $request->validated($request->all());

        $department = Department::create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description
        ]);

        return new DepartmentResource($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->all());
        return $this->success(new DepartmentResource($department), "Department is updated successfullly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response(null, 204);
    }
}
