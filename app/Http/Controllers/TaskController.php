<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): Factory|View{

    $tasks = DB::table('tasks')->get();
      return view('tasks', compact('tasks'));
    }

    public function create(){

        $task_name = $_POST['name'];
    DB::table('tasks')->insert(['name' => $task_name]);

      return redirect()->back();
    }

    public function destroy($id): RedirectResponse{
        DB::table('tasks')->where('id', $id)->delete();

      return redirect()->back();
    }

    public function edit($id): Factory|View{
        $task =DB::table('tasks')->where('id', $id)->first();
        $tasks = DB::table('tasks')->get();
        return view('tasks', compact('task', 'tasks'));
    }

    public function update(): Redirector|RedirectResponse {
        $id = $_POST['id'];
        DB::table('tasks')->where('id', $id)->update(['name'=> $_POST['name']]);
        return redirect('tasks');
    }
}
