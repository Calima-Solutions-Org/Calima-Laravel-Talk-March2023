<div class="p-12">
    <input
        type="text"
        class="w-full p-4 bg-white border-gray-300 rounded-lg"
        placeholder="Search..."
        wire:model="query"
    >

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        @foreach ($notes as $note)
            <article class="mx-auto grid w-full max-w-md rounded-xl bg-white p-8 shadow-md ring-1 ring-gray-900/20">
                <header>
                    <h2 class="text-2xl font-semibold tracking-tight">
                        {{ $note->name }}
                    </h2>

                    <span class="mt-2 text-sm text-gray-500">
                        {{ $note->created_at->since() }}
                    </span>
                </header>

                @if ($note->files->isNotEmpty())
                    <ul class="space-y-1 mt-4">
                        @foreach ($note->files as $file)
                            <li>
                                <a href="{{ $file->file_url }}" target="_blank" class="block bg-gray-50 p-2 rounded text-gray-700 text-xs">{{ $file->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </article>
        @endforeach
    </div>
</div>
