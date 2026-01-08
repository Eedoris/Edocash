<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReasonResource\Pages;
use App\Models\Reason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReasonResource extends Resource
{
    protected static ?string $model = Reason::class;

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Raisons';

    protected static ?string $pluralModelLabel = 'Raisons';

    protected static ?string $modelLabel = 'Raison';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->rows(4),

                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->directory('reasons')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->previewable(true)
                    ->openable()
                    ->downloadable(),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordre d’affichage')
                    ->numeric()
                    ->default(0)
                    ->helperText('Plus petit = affiché en premier'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->visibility('public')
                    ->height(40)
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReasons::route('/'),
            'create' => Pages\CreateReason::route('/create'),
            'edit' => Pages\EditReason::route('/{record}/edit'),
        ];
    }
}
