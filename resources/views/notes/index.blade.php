<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('LightNotes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @if (request()->routeIs('notes.index'))
                <a href="{{ route('notes.create') }}" class="btn-link btn-lg text-violet-800 mb-8">+ New Note</a>
            @endif



            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @forelse($notes as $note)
                    <div class="my-6 p-6 bg-white-800 border border-gray-400 shadow-sm sm:rounded-lg">
                        <h2 class="font-bold text-2xl">


                            {{-- route model binding --}}
                            <a
                            @if (request()->routeIs('notes.index'))
                                href="{{ route('notes.show', $note) }}"
                            @else
                                href="{{ route('trashed.show', $note) }}"
                            @endif
                            >{{ $note->title }}</a>
                        </h2>
                        <p class="mt-2">
                            {{ Str::limit($note->text, 200) }}
                        </p>
                        <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                    </div>

                    @empty
                        @if (request()->routeIs('notes.index'))
                            <p>You Have no posts yet.</p>
                        @else
                            <p>No Item In The Trash.</p>
                        @endif
                    @endforelse


                    {{ $notes->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
