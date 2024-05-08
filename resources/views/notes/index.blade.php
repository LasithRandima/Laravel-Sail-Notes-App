<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('LightNotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('notes.create') }}" class="btn-link btn-lg text-violet-800 mb-8">+ New Note</a>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @forelse($notes as $note)
                    <div class="my-6 p-6 bg-white-800 border border-gray-400 shadow-sm sm:rounded-lg">
                        <h2 class="font-bold text-2xl">
                            <a href="{{ route('notes.show', $note->id) }}">{{ $note->title }}</a>
                        </h2>
                        <p class="mt-2">
                            {{ Str::limit($note->text, 200) }}
                        </p>
                        <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                    </div>

                    @empty
                        <p>You Have no posts yet.</p>
                    @endforelse


                    {{ $notes->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
