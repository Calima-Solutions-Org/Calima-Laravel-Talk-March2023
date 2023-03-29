<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModuleResource\Pages;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('academic_year_id')
                    ->relationship('academic_year', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->string()
                    ->maxLength(80)
                    ->required()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('academic_year.name')
                    ->label('Academic Year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('academic_year_id')
                    ->relationship('academic_year', 'name')
                    ->label('Academic Year'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageModules::route('/'),
        ];
    }
}
