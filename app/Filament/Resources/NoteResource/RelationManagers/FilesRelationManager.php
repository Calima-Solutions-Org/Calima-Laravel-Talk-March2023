<?php

namespace App\Filament\Resources\NoteResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;

class FilesRelationManager extends RelationManager
{
    protected static string $relationship = 'files';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('path')
                    ->label('File')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => $this->ownerRecord->users->where('role', 'owner')->where('user_id', auth()->id())->isNotEmpty()),
            ])
            ->actions([
                Tables\Actions\Action::make('Read')
                    ->url(fn ($record) => $record->file_url)
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->visible(fn () => $this->ownerRecord->users->where('role', 'owner')->where('user_id', auth()->id())->isNotEmpty()),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => $this->ownerRecord->users->where('role', 'owner')->where('user_id', auth()->id())->isNotEmpty()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => $this->ownerRecord->users->where('role', 'owner')->where('user_id', auth()->id())->isNotEmpty()),
            ]);
    }
}
