<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = Admin::with('role')->where('id', '!=', auth()->guard('admin')->user()->id)
            ->when($request->keyword, function (Builder $query) {
                $query->where('name', 'like', '%' . request()->keyword . '%')
                    ->orWhere('email', 'like', '%' . request()->keyword . '%')
                    ->orWhere('username', 'like', '%' . request()->keyword . '%');

            })->when(request()->status, function (Builder $query) {
                $query->where('status', request()->status);

            })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select(['id', 'role_name'])->get();
        return view('admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
//        return $request;
        $request->validated();
        $admin = Admin::create($request->validated());
        if (!$admin) {
            return redirect()->back()->with('error', 'Failed to create admin');
        }
        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::with('role')->findOrFail($id);
        $roles = Role::select(['id', 'role_name'])->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->update($request->except(['_token', '_method', 'password_confirmation']));

        if ($request->password) {
            $admin->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.admins.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $admin = Admin::findOrFail($id);

            $deleted_admin = $admin->delete();
            if (!$deleted_admin) {
                return redirect()->route('admin.admins.index')->with('error', 'admin not deleted');
            }

            return redirect()->route('admin.admins.index')->with('success', 'deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->route('admin.admins.index')->with('error', 'not deleted');
        }
    }

    public function changeStatus(string $id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->status == 'active') {
            $admin->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'blocked successfully');
        } else {
            $admin->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Activated successfully');
        }
    }
}
