<?php

namespace App\Filament\Pages;

use App\Models\HomeAbout;
use App\Models\HomeArtisan;
use App\Models\HomeStats;
use App\Models\Partners;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class HomeAboutPage extends Page
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.home-about-page';

    protected static ?string $navigationLabel = 'À propos (Home)';

    protected static ?string $navigationGroup = 'Contenu du site';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public array $data = [];

    public function mount(): void
    {
        
        $defaultData = [
            'badge' => 'Notre réseau',
            'title' => 'Plus qu\'une application',
            'highlight' => 'une communauté d\'artisans de confiance',
            'intro' => '',
            'cta_label' => 'Qui sommes-nous',
            /*'cta_link' => '/qui-sommes-nous',*/
            'artisans' => [],
            'stats' => [],
            'partners' => [],
        ];

       
        $record = HomeAbout::find(1);
        if ($record) {
            $defaultData = array_merge($defaultData, $record->toArray());
        }

        
        $artisans = HomeArtisan::orderBy('order')->get();
        if ($artisans->isNotEmpty()) {
            $defaultData['artisans'] = $artisans->map(function ($artisan) {
                return [
                    'avatar' => $artisan->avatar,
                    'name' => $artisan->name,
                    'job' => $artisan->job,
                    'description' => $artisan->description,
                    'rating' => $artisan->rating,
                    'experience' => $artisan->experience,
                    'status' => $artisan->status,
                    'location' => $artisan->location,
                    'is_active' => $artisan->is_active,
                ];
            })->toArray();
        }

        
        $stats = HomeStats::orderBy('order')->get();
        if ($stats->isNotEmpty()) {
            $defaultData['stats'] = $stats->map(function ($stat) {
                return [
                    'value' => $stat->value,
                    'label' => $stat->label,
                ];
            })->toArray();
        }

       
        $partners = Partners::orderBy('order')->get();
        if ($partners->isNotEmpty()) {
            $defaultData['partners'] = $partners->map(function ($partner) {
                return [
                    'logo' => $partner->logo,
                    'name' => $partner->name,
                    'type' => $partner->type,
                    'description' => $partner->description,
                    'is_active' => $partner->is_active,
                ];
            })->toArray();
        }

        $this->form->fill($defaultData);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Présentation')
                ->schema([
                    Forms\Components\TextInput::make('badge')->label('Badge'),
                    Forms\Components\TextInput::make('title')->label('Titre')->required(),
                    Forms\Components\TextInput::make('highlight')->label('Texte mis en avant'),
                    Forms\Components\Textarea::make('intro')->label('Introduction'),
                    Forms\Components\TextInput::make('cta_label')
                    ->label('Texte du bouton')
                    ->default(route('about')),
                    /*Forms\Components\TextInput::make('cta_link')->label('Lien du bouton'),*/
                ]),

            Forms\Components\Section::make('Artisans mis en avant')
                ->schema([
                    Forms\Components\Repeater::make('artisans')
                        ->schema([
                            /*Forms\Components\FileUpload::make('avatar')
                                ->image()
                                ->directory('artisans')
                                ->disk('public'),*/
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('job'),
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\TextInput::make('rating'),
                            Forms\Components\TextInput::make('experience'),
                            Forms\Components\TextInput::make('status'),
                            Forms\Components\TextInput::make('location'),
                            Forms\Components\Toggle::make('is_active')->default(true),
                        ])
                        ->columns(2),
                ]),

            Forms\Components\Section::make('Chiffres clés')
                ->schema([
                    Forms\Components\Repeater::make('stats')
                        ->schema([
                            Forms\Components\TextInput::make('value')->required(),
                            Forms\Components\TextInput::make('label')->required(),
                        ])
                        ->columns(2),
                ]),

            Forms\Components\Section::make('Partenaires')
                ->schema([
                    Forms\Components\Repeater::make('partners')
                        ->schema([
                            Forms\Components\FileUpload::make('logo')
                                ->image()
                                ->directory('partners')
                                ->disk('public')
                                ->required(),
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('type'),
                            Forms\Components\Textarea::make('description'),
                            Forms\Components\Toggle::make('is_active')->default(true),
                        ])
                        ->columns(2),
                ]),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

   public function save(): void
{
    try {
       
        HomeAbout::updateOrCreate(
            ['id' => 1],
            [
                'badge' => $this->data['badge'] ?? null,
                'title' => $this->data['title'] ?? '',
                'highlight' => $this->data['highlight'] ?? null,
                'intro' => $this->data['intro'] ?? null,
                'cta_label' => $this->data['cta_label'] ?? null,
                'cta_link' => $this->data['cta_link'] ?? null,
            ]
        );

      
        HomeArtisan::truncate();
        foreach ($this->data['artisans'] ?? [] as $index => $artisanData) {
            if (empty($artisanData['name'])) {
                continue;
            }
            
            $avatar = $artisanData['avatar'] ?? null;
            if (is_array($avatar)) {
                $avatar = !empty($avatar) ? $avatar[0] ?? reset($avatar) : null;
            }
            
            HomeArtisan::create([
                'name' => trim($artisanData['name'] ?? ''),
                'job' => trim($artisanData['job'] ?? ''),
                'description' => trim($artisanData['description'] ?? ''),
                'location' => trim($artisanData['location'] ?? ''),
                'avatar' => $avatar,
                'rating' => $artisanData['rating'] ?? null,
                'experience' => $artisanData['experience'] ?? null,
                'status' => trim($artisanData['status'] ?? ''),
                'order' => (int) $index,
                'is_active' => (bool) ($artisanData['is_active'] ?? true),
            ]);
        }

        
        HomeStats::truncate();
        foreach ($this->data['stats'] ?? [] as $index => $statData) {
            if (empty($statData['value']) || empty($statData['label'])) {
                continue;
            }
            
            HomeStats::create([
                'value' => trim($statData['value']),
                'label' => trim($statData['label']),
                'order' => (int) $index,
            ]);
        }

        
        Partners::truncate();
        foreach ($this->data['partners'] ?? [] as $index => $partnerData) {
            if (empty($partnerData['name'])) {
                continue;
            }
            
            $logo = $partnerData['logo'] ?? null;
            if (is_array($logo)) {
                $logo = !empty($logo) ? $logo[0] ?? reset($logo) : null;
            }
            
            Partners::create([
                'name' => trim($partnerData['name']),
                'type' => trim($partnerData['type'] ?? ''),
                'description' => trim($partnerData['description'] ?? ''),
                'logo' => $logo,
                'order' => (int) $index,
                'is_active' => (bool) ($partnerData['is_active'] ?? true),
            ]);
        }

        Notification::make()
            ->title('Contenu de la Home enregistré avec succès')
            ->success()
            ->send();

    } catch (\Exception $e) {
        Notification::make()
            ->title('Erreur lors de la sauvegarde')
            ->body($e->getMessage())
            ->danger()
            ->send();
            
        throw $e;
    }
}

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
