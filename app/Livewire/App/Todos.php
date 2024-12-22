<?php

namespace App\Livewire\App;

use App\Models\Todo;
use Livewire\Component;
use App\Attributes\UseSvelte;
use Illuminate\Support\Facades\Validator;

#[UseSvelte]
class Todos extends Component
{
    public $todos = [];
    public function mount()
    {
        $this->todos = Todo::all()->toArray();
    }
 
    public function addTodo(string $title)
    {
        $validator = Validator::make(['title' => $title], [
            'title' => 'required|string'
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }
        
        Todo::create(['title' => $title]);
        $this->todos = Todo::all()->toArray();
        return $this->todos;
    }

    public function deleteTodo($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()->toArray()];
        }

        Todo::find($id)->delete();
        $this->todos = Todo::all()->toArray();
        return $this->todos;
    }
}