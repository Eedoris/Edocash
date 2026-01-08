<?php

namespace App\Filament\Resources;

use App\Models\PressArticle;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\PressArticleResource\Pages;

class PressArticleResource extends Resource
{
    protected static ?string $model = PressArticle::class;

    protected static ?string $navigationLabel = 'Article';
    protected static ?string $navigationGroup = 'Medias';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\TextInput::make('title')->required(),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Textarea::make('excerpt')
                ->label('Texte court (card)')
                ->rows(4)
                ->required(),

            Forms\Components\RichEditor::make('content')
                ->label('Contenu article')
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->disk('public')
                ->directory('press')
                ->image()
                ->required(),

            Forms\Components\Select::make('category')
                ->options([
                    'press' => 'Presse écrite',
                    'tv' => 'Télévision',
                    'web' => 'Web',
                    'release' => 'Communiqué',
                    'other' => 'Autres',
                ]),
                

            Forms\Components\TextInput::make('external_url')
                ->label('Lien média externe')
                ->url(),

            Forms\Components\DatePicker::make('published_at'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('category'),
            Tables\Columns\TextColumn::make('published_at')->date(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPressArticles::route('/'),
            'create' => Pages\CreatePressArticle::route('/create'),
            'edit' => Pages\EditPressArticle::route('/{record}/edit'),
        ];
    }
}
