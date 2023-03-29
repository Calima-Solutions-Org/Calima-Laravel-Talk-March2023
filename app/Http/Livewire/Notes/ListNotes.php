<?php

namespace App\Http\Livewire\Notes;

use App\Models\Note;
use App\Models\Report;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Livewire\Component;

class ListNotes extends Component implements HasActions
{
    use InteractsWithActions;

    public string $query = '';

    public function render()
    {
        return view('livewire.notes.list-notes', [
            'notes' => Note::with('files')
                ->when(! empty($this->query), fn ($query) => $query->where('name', 'like', '%'.$this->query.'%'))
                ->orderBy('votes', 'desc')
                ->get(),
        ]);
    }

    // Upvote action

    // Downvote action

    // Email share action

    // WhatsApp share action

    // Report action
}
