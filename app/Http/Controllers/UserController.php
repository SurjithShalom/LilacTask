<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\View\View;
class UserController extends Controller
{
    public function index(): View {
        $users = User::with(['department', 'designation'])->paginate(10);
        return view('Users.index', compact('users'));
    }
    public function search(Request $request) {
        $query = User::query()->with(['department', 'designation']);

        if ($search = $request->input('search')) {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhereHas('department', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('designation', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }

        return $query->get();
    }
}
