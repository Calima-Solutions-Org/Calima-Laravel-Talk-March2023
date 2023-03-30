<?php

namespace App\Filament\Resources\NoteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->visible(fn () => $this->ownerRecord->users->where('role', 'owner')->where('user_id', auth()->id())->isNotEmpty()),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->visible(fn () => $this->ownerRecord->users->where('role', 'owner')->where('user_id', auth()->id())->isNotEmpty()),
            ])
            ->bulkActions([
            ])
            ->query(fn () => $this->ownerRecord->users()->where('role', 'viewer'));
    }
}
