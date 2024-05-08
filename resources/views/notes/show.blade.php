<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 leading-tight">
            {{-- {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }} --}}
            {{ !$note->trashed() ? __('Notes') :  __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- @if (session('success'))
                {{ session('success') }}
            @endif --}}

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>


            <div class="flex text-red-600">
                @if (!$note->trashed())
                <p class="opacity-70 text-red-600">
                    <strong class="">Created: </strong> {{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8 ms-3">
                    <strong>Updated: </strong> {{ $note->updated_at->diffForHumans() }}
                </p>
                <a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit note</a>

                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure to move this Note to Trash?')">Move to Trash</button>
                </form>

                @else

                <p class="opacity-70 ml-8 ms-3">
                    <strong>Deleted: </strong> {{ $note->deleted_at->diffForHumans() }}
                </p>

                <form action="{{ route('trashed.update', $note) }}" method="post" class="ml-auto">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4">Restore Note</button>
                </form>


                <form action="{{ route('trashed.destroy', $note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure to delete this Note forever? This action cannot be undone.')">Delete Permently</button>
                </form>
                @endif

            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $note->title }}
                </h2>
                <p class="mt-6 whitespace-pre-wrap">{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
