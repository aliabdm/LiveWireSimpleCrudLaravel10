<div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>name</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody wire:sortable='updatePriority'>
            @forelse($tasks as $task)
            <tr wire:sortable.item={{ $task->id }} wire:key="task-{{ $task->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->name }}</td>
                <td>
                <button wire:click="edit({{ $task->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $task->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    No Data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
