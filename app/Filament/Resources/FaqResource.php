<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use App\Models\FaqCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextInput;
use Illuminate\Support\Str;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
 protected static ?string $navigationGroup = 'FAQ';
    protected static ?string $navigationLabel = 'Questions FAQ';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('question')
                ->required()
                ->columnSpanFull(),

            Forms\Components\RichEditor::make('answer')
                ->required()
                ->columnSpanFull(),

            Forms\Components\Select::make('faq_category_id')
                ->label('Catégorie')
                ->nullable()
                ->searchable()
                ->preload()
                ->options(
                    FaqCategory::orderBy('name')->pluck('name', 'id')
                )
                ->createOptionForm([
                     Forms\Components\TextInput::make('name')
                        ->label('Nouvelle catégorie')
                        ->required()
                        ->unique('faq_categories', 'name'),
                ])
                ->createOptionUsing(function (array $data) {
                    return FaqCategory::firstOrCreate(
                        ['name' => $data['name']],
                        ['slug' => Str::slug($data['name'])]
                    )->id;
                }),

            Forms\Components\Toggle::make('is_active')
                ->default(true),

            Forms\Components\TextInput::make('sort_order')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('question')->limit(50)->searchable(),
            TextColumn::make('category.name')->label('Catégorie'),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('sort_order')->sortable(),
        ])->defaultSort('sort_order');
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
