<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->keyword, function (Builder $query) {
            $query->where('name', 'like', '%' . request()->keyword . '%')
                ->orWhere('email', 'like', '%' . request()->keyword . '%')
                ->orWhere('phone', 'like', '%' . request()->keyword . '%');
        })->when(request()->status, function (Builder $query) {

            $query->where('status', request()->status);
        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $request->merge([
                'email_verified_at' => $request->email_verified_at == 'active' ? now() : null,
            ]);
            $user = User::create($request->except('avatar'));
            ImageManager::uploadImage($request, null, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create user, please try again later.');
        }
        return redirect()->back()->with('success', 'created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show_user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 'active') {
            $user->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'User blocked successfully');
        } else {
            $user->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'User Activated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            // delete user avatar image
            if ($user->avatar) {
                ImageManager::deleteImageLocal($user->avatar);
            }
            $user->delete();
            DB::commit();
            return to_route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return to_route('admin.users.index')->with('error', 'Failed to delete user try again later.');
        }
    }
}
