<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;

class HomeAboutPage extends Page
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.home-about-page';

    protected static ?string $navigationLabel = 'À propos';
    protected static ?string $navigationGroup = 'Contenu du site';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    /** Données du formulaire */
    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'badge' => 'Notre réseau',
            'title' => 'Plus qu\'une application',
            'highlight' => 'une communauté d’artisans',
            'intro' => '',
            'cta_label' => 'Qui sommes-nous',
            'cta_link' => '/qui-sommes-nous',
            'artisans' => [],
            'stats' => [],
            'partners' => [],
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([

                Section::make('Présentation')
                    ->schema([
                        TextInput::make('badge')->label('Badge'),
                        TextInput::make('title')->label('Titre')->required(),
                        TextInput::make('highlight')->label('Texte mis en avant'),
                        Textarea::make('intro')->label('Introduction'),
                        TextInput::make('cta_label')->label('Texte du bouton'),
                        TextInput::make('cta_link')->label('Lien du bouton'),
                    ]),

                Section::make('Artisans mis en avant')
                    ->schema([
                        Repeater::make('artisans')
                            ->schema([
                                FileUpload::make('avatar')->image(),
                                TextInput::make('name')->required(),
                                TextInput::make('job'),
                                Textarea::make('description'),
                                TextInput::make('rating'),
                                TextInput::make('experience'),
                                TextInput::make('status'),
                                TextInput::make('location'),
                                Toggle::make('is_active')->default(true),
                            ]),
                    ]),

                Section::make('Chiffres clés')
                    ->schema([
                        Repeater::make('stats')
                            ->schema([
                                TextInput::make('value')->required(),
                                TextInput::make('label')->required(),
                            ]),
                    ]),

                Section::make('Partenaires')
                    ->schema([
                        Repeater::make('partners')
                            ->schema([
                                FileUpload::make('logo')->image()->required(),
                                TextInput::make('name')->required(),
                                TextInput::make('type'),
                                Textarea::make('description'),
                                Toggle::make('is_active')->default(true),
                            ]),
                    ]),
            ]);
    }
    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
