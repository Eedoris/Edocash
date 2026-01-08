<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MotifResource\Pages;
use App\Models\Motif;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MotifResource extends Resource
{
    protected static ?string $model = Motif::class;

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Motif';

    protected static ?string $pluralModelLabel = 'Motif';

    protected static ?string $modelLabel = 'Motif';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Section Motif')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titre de la section')
                            ->required(),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Sous-titre')
                            ->required(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Image principale')
                            ->disk('public')
                            ->directory('motifs')
                            ->image()
                            ->visibility('public'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Contenu (items)')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->label('Items du motif')
                            ->orderColumn('sort_order')
                            ->defaultItems(1)
                            ->collapsible()
                            ->itemLabel(fn (array $state) => $state['title'] ?? 'Nouvel item')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titre')
                                    ->required(),

                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->required(),

                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->height(40)
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Sous-titre')
                    ->limit(40),
               
            ])
            ->actions([
                Tables\Actions\EditAction::make(),   
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMotifs::route('/'),
            'create' => Pages\CreateMotif::route('/create'),
            'edit' => Pages\EditMotif::route('/{record}/edit'),
        ];
    }
}
