<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Employee as ModelsEmployee;
use Livewire\Component;

class Employee extends Component
{
    public $name, $department_id;
    public $departments;
    public $employee;

    public $editId = null;

    public function mount(){ //  fungsi lifecycle (siklus hidup) yang akan dijalankan sekali saja saat komponen pertama kali dimuat.
        $this->departments = Department::all(); 
    }
    
    public function render()
    {
        // read data 
        return view('livewire.employee',[
            'karyawan' => ModelsEmployee::with('department')->get()
        ]);
    }
    public function store(){
        $rules = [
            'name' => 'required',
            'department_id' => 'required|exists:departments,id',
        ];

        ModelsEmployee::create([
            'name' => $this->name,
            'department_id' => $this->department_id,
        ]);

        session()->flash('success', 'Pegawai berhasil disimpan.');
        $this->reset(['name', 'department_id']);
    }

    public function edit($id){
        $pegawai = ModelsEmployee::findOrfail($id);
        $this->editId = $pegawai->id;
        $this->name = $pegawai->name;
        $this->department_id = $pegawai->department_id;
    }

    public function update(){
        $this->validate([
            'name'=>'required',
            'department_id' => 'required|exists:departments,id'
        ]);

        $pegawai = ModelsEmployee::findOrFail($this->editId);
        $pegawai->update([
            'name'=>$this->name,
            'department_id'=>$this->department_id
        ]);

        session()->flash('success', 'Data pegawai berhasil diperbarui.');
        $this->reset(['name', 'department_id', 'editId']);
    }

    public function delete($id){
        $pegawai = ModelsEmployee::findOrFail($id);
        $pegawai->delete();
        session()->flash('success','deleted successfully');
    }
}
