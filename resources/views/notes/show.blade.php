<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
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
                <p class="opacity-70 text-red-600">
                    <strong class="">Created: </strong> {{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8 ms-3">
                    <strong>Updated at: </strong> {{ $note->updated_at->diffForHumans() }}
                </p>
                <a href="{{ route('notes.edit', $note) }}" class="btn-link ml-auto">Edit note</a>
                
                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure to delete this Note?')">Delete Note</button>
                </form>
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