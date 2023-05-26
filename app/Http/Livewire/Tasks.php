<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{
    public $tasks, $name, $priority, $task_id;
    public $updateMode = false;

    public function render()
    {
        $this->tasks = Task::orderBy('priority')->get();
        return view('livewire.tasks');
    }

    private function resetInputFields(){
        $this->name = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
        ]);

        Task::create($validatedDate);

        session()->flash('message', 'Task Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->task_id = $id;
        $this->name = $task->name;

        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
        ]);

        $task = Task::find($this->task_id);
        $task->update([
            'name' => $this->name,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Task Updated Successfully.');
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Task::find($id)->delete();
        session()->flash('message', 'Task Deleted Successfully.');
    }

    public function updatePriority($list)
    {
        foreach ($list as $item) {
            Task::find($item['value'])->update(['priority'=>$item['order']]);
        }
    }
}
