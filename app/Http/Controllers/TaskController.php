<?php

namespace App\Http\Controllers;

use App\Models\Task;
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

    //$tasks = DB::table('tasks')->get();
    $tasks = Task::all();
      return view('tasks', compact('tasks'));
    }

    public function create(Request $request)
    {

    $validated = $request->validate(['name'=> 'required']);
        $task_name = $request->name;
    //DB::table('tasks')->insert(['name' => $task_name]);
       $task = new Task;
       $task->name = $task_name;
        $task->save();

      return redirect()->back();
    }

    public function destroy($id): RedirectResponse{
            $task = Task::find($id);

            if ($task) {
                $task->delete();
            }

      //  DB::table('tasks')->where('id', $id)->delete();

      return redirect()->back();
    }

    public function edit($id): Factory|View{
        $task = Task::find($id);
        $tasks = Task::all();
    //    $task =DB::table('tasks')->where('id', $id)->first();
       // $tasks = DB::table('tasks')->get();
        return view('tasks', compact('task', 'tasks'));
    }

    /*public function update(): Redirector|RedirectResponse {
        $id = $_POST['id'];
        DB::table('tasks')->where('id', $id)->update(['name'=> $_POST['name']]);
        return redirect('tasks');
    }*/
        public function update(Request $request)
{
    $request->validate([
        'name' => 'required|min:3|max:255'
    ]);
    $task = Task::find($request->id);

    $task->name = $request->name;
    $task->save();
  /*  DB::table('tasks')
        ->where('id', $request->id)
        ->update([
            'name' => $request->name
        ]);*/

    return redirect('tasks');
}
}
