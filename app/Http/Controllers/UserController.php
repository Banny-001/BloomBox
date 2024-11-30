<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use LaravelChartjs\Facades\Chartjs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('index', compact('users'));
        Log::info($users);
    }
   
    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('index')->with('success', 'User created successfully.');
    }
    public function edit(User $user)
    {
        return view('edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('index')->with('success', 'User updated successfully.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('index')->with('success', 'User deleted successfully.');
    }
    // public function showChart()
    // {
    //     $start=Carbon::parse(User::min('created_at'));
    //     $end = Carbon::now();
    //     $period = CarbonPeriod::create($start, "1 month", $end);

    //     $usersPerMonth = collect($period)->map(function ($date) {
    //         $endDate = $date->copy()->endOfMonth();

    //         return [
    //             "count" => User::where("created_at", "<=", $endDate)->count(),
    //             "month" => $endDate->format("Y-m-d")
    //         ];
    //     }); 
    //     $data = $usersPerMonth->pluck("count")->toArray();
    //     $labels = $usersPerMonth->pluck("month")->toArray();

    //     // $chart = Chartjs::build()
    //     // ->name("UserRegistrationsChart")
    //     // ->type("line")
    //     // ->size(["width" => 400, "height" => 200])
    //     // ->labels($labels)
    //     // ->datasets([
    //     //     [
    //     //         "label" => "User Registrations",
    //     //         "backgroundColor" => "rgba(38, 185, 154, 0.31)",
    //     //         "borderColor" => "rgba(38, 185, 154, 0.7)",
    //     //         "data" => $data
    //     //     ]
    //     //     ])
    //     //     ->options([
    //     //         'scales' => [
    //     //             'x' => [
    //     //                 'type' => 'time',
    //     //                 'time' => [
    //     //                     'unit' => 'month'
    //     //                 ],
    //     //                 'min' => $start->format("Y-m-d"),
    //     //             ]
    //     //         ],
    //     //         'plugins' => [
    //     //             'title' => [
    //     //                 'display' => true,
    //     //                 'text' => 'Monthly User Registrations'
    //     //             ]
    //     //         ]
    //     //     ]);
    //         return view("user.chart", compact("chart"));


    // }
}
