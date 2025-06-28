<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $roles = Role::when($request->keyword, function (Builder $query) {
            $query->where('role_name', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $request->validated();
        try {
            $role = Role::create([
                'role_name' => $request->role_name,
                'status' => $request->status,
                'permissions' => json_encode($request->permissions),
            ]);

            if (!$role) {
                return redirect()->back()->with('error', 'Role not created, please try again!');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Role not created, please try again!');
        }
        return redirect()->route('admin.roles.index')->with('success', 'created successfully!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail($id);
        $request->validated();
        try {
            $role->update([
                'role_name' => $request->role_name,
                'status' => $request->status,
                'permissions' => json_encode($request->permissions),
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Role not updated, please try again!');
        }
        return redirect()->route('admin.roles.index')->with('success', 'updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);

            if ($role->admins->count() > 0) {
                return redirect()->back()->with('error', 'Failed to delete. This role is assigned to one or more admins.');
            }

            if (!$role) {
                return redirect()->back()->with('error', 'Failed to delete. Please try again.');
            }
            $role->delete();

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Failed to delete. Please try again.');
        }
        return to_route('admin.roles.index')->with('success', 'deleted successfully.');
    }

    public function changeStatus(string $id)
    {
        $role = Role::findOrFail($id);

        if ($role->status == 'active') {
            $role->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'blocked successfully');
        } else {
            $role->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Activated successfully');
        }
    }
}
