<?php

namespace App\Filament\Pages;

use App\Models\Motivation;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class MotivationPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Motivations';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static string $view = 'filament.pages.motivation-page';

    public array $data = [];

    public Motivation $motivation;

    public function mount(): void
    {
        $this->motivation = Motivation::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Les mots qui nous motivent',
                'subtitle' => 'chaque jour',
            ]
        );

         $this->form->fill(
        $this->motivation->toArray()
    );
    }

    protected function getFormModel(): Motivation
    {
        return $this->motivation;
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Section Motivation')
                ->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\TextInput::make('subtitle'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Cartes')
                ->schema([
                    Forms\Components\Repeater::make('items')
                        ->relationship('items')
                        ->orderColumn('sort_order')
                        ->collapsible()
                        ->itemLabel(fn ($state) => $state['title'] ?? 'Nouvelle carte')
                        ->schema([
                            Forms\Components\TextInput::make('title')->required(),
                            Forms\Components\Textarea::make('description')->rows(4)->required(),
                            Forms\Components\TextInput::make('author'),
                            Forms\Components\DatePicker::make('published_at'),
                            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                        ])
                        ->columns(2),
                ]),
        ];
    }

    public function save(): void
    {

        $state = $this->form->getState();

        $this->motivation->update([
            'title' => $state['title'],
            'subtitle' => $state['subtitle'] ?? null,
        ]);

        $this->form->model($this->motivation)->saveRelationships();

        Notification::make()
            ->title('Motivations mises à jour')
            ->success()
            ->send();
    }
}
