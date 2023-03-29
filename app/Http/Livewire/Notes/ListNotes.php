<?php

namespace App\Http\Livewire\Notes;

use App\Models\Note;
use App\Models\Report;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Livewire\Component;

class ListNotes extends Component implements HasActions
{
    use InteractsWithActions;

    public string $query = '';

    public function render()
    {
        return view('livewire.notes.list-notes', [
            'notes' => Note::with('files')
                ->when(!empty($this->query), fn ($query) => $query->where('name', 'like', '%'.$this->query.'%'))
                ->orderBy('votes', 'desc')
                ->get(),
        ]);
    }

    public function upvoteAction(): Action
    {
        return Action::make('upvoteAction')
            ->iconButton()
            ->icon('heroicon-m-arrow-up')
            ->action(fn (array $arguments) => Note::find($arguments['note'])->increment('votes'));
    }

    public function downvoteAction(): Action
    {
        return Action::make('downvoteAction')
            ->iconButton()
            ->icon('heroicon-m-arrow-down')
            ->color('danger')
            ->action(fn (array $arguments) => Note::find($arguments['note'])->decrement('votes'))
            ->requiresConfirmation();
    }

    public function emailShareAction(): Action
    {
        return Action::make('emailShareAction')
            ->icon('heroicon-m-envelope')
            ->color('gray')
            ->url(function (array $arguments): string {
                $note = Note::find($arguments['note']);

                return 'mailto:?subject='.rawurlencode($note->name).'&body='.rawurlencode(route('notes.view', $note));
            });
    }

    public function whatsappShareAction(): Action
    {
        return Action::make('whatsappShareAction')
            ->icon('heroicon-m-chat-bubble-oval-left')
            ->color('gray')
            ->url(
                function (array $arguments): string {
                    $note = Note::find($arguments['note']);

                    return 'https://wa.me/?text='.rawurlencode(route('notes.view', $note));
                },
                shouldOpenInNewTab: true,
            );
    }

    public function shareActionGroup(Note $note): ActionGroup
    {
        return ActionGroup::make([
            ($this->emailShareAction)(['note' => $note->id]),
            ($this->whatsappShareAction)(['note' => $note->id]),
        ])
            ->icon('heroicon-m-share')
            ->color('gray');
    }

    public function reportAction(): Action
    {
        return Action::make('reportAction')
            ->iconButton()
            ->icon('heroicon-m-flag')
            ->color('danger')
            ->form([
                Radio::make('reason')
                    ->options([
                        'spam' => 'Spam',
                        'inappropriate' => 'Inappropriate',
                        'other' => 'Other',
                    ])
                    ->required(),
                Textarea::make('message'),
            ])
            ->modalWidth('md')
            ->modalHeading('Report note')
            ->action(function (array $data, array $arguments) {
                $report = new Report();
                $report->reason = $data['reason'];
                $report->message = $data['message'];
                $report->note()->associate(Note::find($arguments['note']));
                $report->save();

                Notification::make()
                    ->success()
                    ->title('Note has been reported')
                    ->body('Thank you for reporting this note. We will review it shortly.')
                    ->send();
            });
    }
}
