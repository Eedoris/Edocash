<?php

namespace App\Filament\Pages;

use App\Models\HomeHero as HomeHeroModel;
use App\Models\HomeHeroHistory;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class HomeHero extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Accueil';

    protected static ?string $navigationGroup = 'Site';

    protected static string $view = 'filament.pages.home-hero';

    public string $activeTab = 'edit';

    public ?int $selectedHistoryId = null;

    public array $data = [];

    public function mount(): void
    {
        $hero = HomeHeroModel::first();

        if ($hero) {
            $this->data = $hero->toArray();

            if (is_string($this->data['background_image'])) {
                $this->data['background_image'] = null;
            }
            if (isset($this->data['jobs'])) {
                if (is_string($this->data['jobs'])) {
                    $this->data['jobs'] = json_decode($this->data['jobs'], true) ?? [];
                }

                if (! is_array($this->data['jobs'])) {
                    $this->data['jobs'] = [];
                }
            }
        } else {
            $this->data = [
                'background_image' => null,
                'title_before' => 'Les meilleurs',
                'title_after' => 'sont déjà en chemin !',
                'jobs' => [
                    ['value' => 'plombier'],
                    ['value' => 'électricien'],
                    ['value' => 'serrurier'],
                    ['value' => 'chauffagiste'],
                ],
                'subtitle' => '+500 000 interventions depuis 2013.',
                'cta_text' => 'J\'ai besoin d\'être dépanné',
                'cta_link' => '#',
            ];
        }

        $this->form->fill($this->data);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Image de fond')
                ->schema([
                    Forms\Components\FileUpload::make('background_image')
                        ->label('Image')
                        ->directory('hero')
                        ->image()
                        ->disk('public')
                        ->imagePreviewHeight('200')
                        ->helperText('Format: JPG, PNG. Max: 2MB'),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Titres')
                ->schema([
                    Forms\Components\TextInput::make('title_before')
                        ->label('Texte avant le mot animé')
                        ->required()
                        ->maxLength(100),

                    Forms\Components\TextInput::make('title_after')
                        ->label('Texte après le mot animé')
                        ->required()
                        ->maxLength(100),
                ])
                ->columns(2),

            Forms\Components\Section::make('Métiers animés')
                ->schema([
                    Forms\Components\Repeater::make('jobs')
                        ->label('Liste des métiers')
                        ->schema([
                            Forms\Components\TextInput::make('value')
                                ->label('Métier')
                                ->required()
                                ->maxLength(50),
                        ])
                        ->minItems(1)
                        ->reorderable()
                        ->collapsible()
                        ->cloneable()
                        ->helperText('Ces mots défileront automatiquement')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Forms\Components\Section::make('Contenu secondaire')
                ->schema([
                    Forms\Components\TextInput::make('subtitle')
                        ->label('Texte sous le titre')
                        ->required()
                        ->maxLength(200),

                    Forms\Components\TextInput::make('cta_text')
                        ->label('Texte du bouton')
                        ->required()
                        ->maxLength(50),

                    Forms\Components\TextInput::make('cta_link')
                        ->label('Lien du bouton')
                        ->required(false)
                        ->maxLength(255)
                        ->helperText('Laissez vide ou mettez # pour pas de lien'),
                ])
                ->collapsible(),
        ];
    }

    public function save(): void
    {
        try {

            $data = $this->form->getState();

            if (empty($data['cta_link']) || $data['cta_link'] === '#') {
                $data['cta_link'] = '#';
            }

            $hero = HomeHeroModel::updateOrCreate(
                ['id' => 1],
                $data
            );

            Notification::make()
                ->title('Modifications enregistrées')
                ->body('Une nouvelle version a été ajoutée à l\'historique.')
                ->success()
                ->send();

            $this->data = $hero->toArray();

            if (is_string($this->data['background_image'])) {
                $this->data['background_image'] = null;
            }

            $this->form->fill($this->data);

        } catch (\Exception $e) {
            Notification::make()
                ->title('Erreur')
                ->body('Erreur: '.$e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Afficher les détails d'une version historique
     */
    public function showHistory(int $historyId): void
    {
        $this->selectedHistoryId = $historyId;
        $this->dispatch('open-modal', id: 'history-detail');
    }

    /**
     * Restaurer une ancienne version
     */
    public function restoreHistory(): void
    {
        $history = HomeHeroHistory::find($this->selectedHistoryId);

        if ($history && $history->homeHero) {
            $data = $history->data;

            // 🔐 NORMALISER jobs AVANT restore
            if (isset($data['jobs'])) {
                if (is_string($data['jobs'])) {
                    $decoded = json_decode($data['jobs'], true);

                    // Cas JSON doublement encodé
                    if (is_string($decoded)) {
                        $decoded = json_decode($decoded, true);
                    }

                    $data['jobs'] = is_array($decoded) ? $decoded : [];
                }

                if (! is_array($data['jobs'])) {
                    $data['jobs'] = [];
                }
            }

            // Restore propre
            $history->homeHero->update($data);

            Notification::make()
                ->title('Version restaurée')
                ->body('L\'ancienne version a été restaurée avec succès.')
                ->success()
                ->send();

            // Recharger le formulaire
            $this->data = $history->homeHero->toArray();

            // ⚠️ FileUpload ne doit pas recevoir une string
            if (is_string($this->data['background_image'])) {
                $this->data['background_image'] = null;
            }

            $this->form->fill($this->data);

            $this->dispatch('close-modal', id: 'history-detail');
        }
    }

    /**
     * Données pour la vue
*/
    protected function getViewData(): array
{
    $hero = HomeHeroModel::first();

    return [
        'histories' => $hero
            ? $hero->histories()
                ->latest()
                ->limit(10) 
                ->get()
            : collect(),

        'current' => $hero,

        'selectedHistory' => $this->selectedHistoryId
            ? HomeHeroHistory::find($this->selectedHistoryId)
            : null,
    ];
}


    public function getJobsArrayProperty()
    {
        $hero = HomeHeroModel::first();
        if (! $hero) {
            return [];
        }

        $jobs = $hero->jobs;

        if (is_string($jobs)) {
            return json_decode($jobs, true) ?? [];
        }

        return is_array($jobs) ? $jobs : [];
    }

    /*public static function getNavigationBadge(): ?string
    {
        $hero = HomeHeroModel::first();

        if (! $hero) {
            return 'New';
        }

        $count = $hero->histories()->count();

        return $count > 0 ? (string) $count : null;
    }*/

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
