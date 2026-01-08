<?php

namespace App\Filament\Pages;

use App\Models\PressSection;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PressSectionPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Presse';

    protected static ?string $navigationGroup = 'Medias';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static string $view = 'filament.pages.press-section-page';

    public array $data = [];

    public PressSection $press;

    protected function getFormModel(): PressSection
    {
        return $this->press;
    }

    public function mount(): void
    {
        $this->press = PressSection::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'EdoCash',
                'subtitle' => 'dans les médias',
                'intro' => 'Découvrez nos interventions et reportages dans les principaux médias',
            ]
        );

        $this->form->fill(
            $this->press->toArray()
        );

    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        return [

            Forms\Components\Section::make('Contenu principal')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre')
                        ->required(),

                    Forms\Components\TextInput::make('subtitle')
                        ->label('Sous-titre')
                        ->required(),

                    Forms\Components\Textarea::make('intro')
                        ->label('Introduction')
                        ->rows(3)
                        ->required(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Vidéo')
                ->schema([
                    Forms\Components\TextInput::make('video_url')
                        ->label('URL vidéo (YouTube embed)')
                        ->placeholder('https://www.youtube.com/embed/...'),

                    Forms\Components\TextInput::make('video_title')
                        ->label('Titre de la vidéo'),
                ]),

            Forms\Components\Section::make('Citations presse (Homepage)')
                ->schema([
                    Forms\Components\Repeater::make('items')
                        ->label('Articles presse')
                        ->relationship('items')
                        ->orderColumn('sort_order')
                        ->collapsible()
                        ->itemLabel(fn ($state) => $state['source'] ?? 'Nouvel article')
                        ->schema([
                            Forms\Components\Textarea::make('quote')
                                ->label('Citation')
                                ->rows(3)
                                ->required(),

                            Forms\Components\TextInput::make('source')
                                ->label('Nom du média')
                                ->required(),

                            Forms\Components\TextInput::make('external_url')
                                ->label('Lien vers l’article (site externe)')
                                ->placeholder('https://www.leparisien.fr/...')
                                ->url()
                                ->helperText('Lien vers l’article original du média'),

                            Forms\Components\FileUpload::make('media_logo')
                                ->label('Logo du média')
                                ->disk('public')
                                ->directory('press-logos')
                                ->image(),

                            Forms\Components\DatePicker::make('published_at')
                                ->label('Date'),

                            Forms\Components\TextInput::make('sort_order')
                                ->numeric()
                                ->default(0),
                        ])
                        ->columns(2),
                ]),

        ];
    }

    public function save(): void
    {

        $this->press->update($this->data);

        $this->form->model($this->press)->saveRelationships();

        Notification::make()
            ->title('Section presse mise à jour')
            ->success()
            ->send();
    }
}
