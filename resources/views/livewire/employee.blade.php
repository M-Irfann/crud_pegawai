<div>
    <div class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <form>
       
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="name" class="form-control">
                    </div>
                </div>
            
                <div class="mb-3 row">
                    <label for="department_id" class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10">
                        <select wire:model="department_id" class="form-control">
                            <option value="">-- Pilih Department --</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
       
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        {{-- <button type="submit" class="btn btn-primary" name="submit" wire:click="store()">SIMPAN</button> --}}
                        @if ($editId)
                            <button type="button" class="btn btn-success" wire:click="update()">UPDATE</button>
                            <button type="button" class="btn btn-secondary ms-2" wire:click="$set('editId', null)">BATAL</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="store()">SIMPAN</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h1>Data Pegawai</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Department</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawan as $index => $employee)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->department->name ?? '-' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $employee->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $employee->id }})">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Belum ada data pegawai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
    </div>
</div>
