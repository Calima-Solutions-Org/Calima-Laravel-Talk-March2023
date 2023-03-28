<div class="grid gap-8 p-12">
    @foreach (\App\Models\Note::all() as $note)
        <article class="mx-auto grid w-full max-w-md rounded-xl bg-white p-8 shadow-md ring-1 ring-gray-900/20">
            <header>
                <h2 class="text-2xl font-semibold tracking-tight">
                    {{ $note->name }}
                </h2>

                <span class="mt-2 text-sm text-gray-500">
                    {{ $note->created_at->since() }}
                </span>
            </header>

            <p class="mt-3">
                Magnam aut ea odit quisquam voluptatibus. Non et sit illo eum itaque iste impedit. Ab nihil recusandae porro ut qui qui dolores. Perferendis nihil repellendus consectetur consequatur id quis autem.
            </p>

            <footer class="-mb-4 -mx-2 mt-4 flex justify-between">
                <div class="flex items-center">
                    {{ ($this->upvoteAction)(['note' => $note->id]) }}

                    {{ ($this->downvoteAction)(['note' => $note->id]) }}

                    <span class="ml-3 text-sm text-gray-500">
                        {{ $note->votes }}
                    </span>
                </div>

                <div class="flex">
                    {{ $this->shareActionGroup($note) }}

                    {{ ($this->reportAction)(['note' => $note->id]) }}
                </div>
            </footer>
        </article>
    @endforeach

    <x-filament-actions::modals />
</div>
