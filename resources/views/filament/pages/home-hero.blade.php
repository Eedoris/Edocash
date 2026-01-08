<x-filament-panels::page>

    {{-- Onglets --}}
    <x-filament::tabs>
        <x-filament::tabs.item wire:click="$set('activeTab', 'edit')" :active="$activeTab === 'edit'" icon="heroicon-o-pencil">
            Éditer
        </x-filament::tabs.item>

        <x-filament::tabs.item wire:click="$set('activeTab', 'history')" :active="$activeTab === 'history'" icon="heroicon-o-clock"
            >
            Historique
        </x-filament::tabs.item>
        {{-- :badge="count($histories)" --}}
    </x-filament::tabs>

    {{-- Contenu selon l'onglet --}}
    @if ($activeTab === 'edit')
        <x-filament::card class="mt-6">
            {{-- En-tête info --}}
            @if ($current && $current->updated_at)
                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-center text-sm text-blue-700">
                        <x-filament::icon icon="heroicon-o-information-circle" class="w-5 h-5 mr-2" />
                        <div>
                            <span class="font-medium">Dernière modification :</span>
                            {{ $current->updated_at->diffForHumans() }}

                            @php $lastHistory = $histories->first(); @endphp
                            @if ($lastHistory && $lastHistory->modified_by)
                                par <span class="font-medium">{{ $lastHistory->modified_by }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Formulaire --}}
            <form wire:submit.prevent="save" class="space-y-6">
                {{ $this->form }}

                <div class="flex justify-between items-center pt-6 border-t">
                    <div class="text-sm text-gray-500">
                        Cette modification sera ajoutée à l'historique
                    </div>
                    <x-filament::button type="submit" icon="heroicon-o-check" size="lg">
                        Enregistrer une nouvelle version
                    </x-filament::button>
                </div>
            </form>
        </x-filament::card>
    @else
        {{-- historique --}}
        <x-filament::card class="mt-6">
            <x-filament::section heading="Historique des modifications">
                @if (count($histories) > 0)
                    <div class="space-y-4">
                        @foreach ($histories as $history)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <div class="flex items-center">
                                            @if ($history->modified_by === 'System')
                                                <x-filament::icon icon="heroicon-o-computer-desktop"
                                                    class="w-4 h-4 text-gray-400 mr-2" />
                                                <span class="font-medium text-gray-600">Système</span>
                                            @else
                                                <x-filament::icon icon="heroicon-o-user"
                                                    class="w-4 h-4 text-blue-500 mr-2" />
                                                <span
                                                    class="font-medium text-gray-800">{{ $history->modified_by }}</span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">
                                            @if ($history->created_at)
                                                {{ $history->created_at->format('d/m/Y à H:i') }}
                                                ({{ $history->created_at->diffForHumans() }})
                                            @else
                                                <span class="italic text-gray-400">Date inconnue</span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="flex gap-2">
                                        <x-filament::icon-button icon="heroicon-o-eye"
                                            wire:click="showHistory({{ $history->id }})" color="gray" size="sm"
                                            tooltip="Voir les détails" />

                                        @if ($loop->first)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <x-filament::icon icon="heroicon-o-check" class="w-3 h-3 mr-1" />
                                                Actuel
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="text-sm">
                                    <div class="font-medium text-gray-700 mb-1">Contenu :</div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <div class="text-gray-500 mb-1">Titres :</div>
                                            « {{ $history->getDataValue('title_before', 'N/A') }} »<br>
                                            « {{ $history->getDataValue('title_after', 'N/A') }} »
                                        </div>
                                        <div>
                                            <div class="text-gray-500 mb-1">Métiers :</div>
                                            <div class="flex flex-wrap gap-1">
                                                @php
                                                    $jobsData = $history->getDataValue('jobs', []);

                                                    // 🔐 Sécurisation totale
                                                    if (is_string($jobsData)) {
                                                        $jobsData = json_decode($jobsData, true) ?? [];
                                                    }

                                                    $jobs = is_array($jobsData) ? $jobsData : [];
                                                    $limitedJobs = array_slice($jobs, 0, 3);
                                                @endphp

                                                @foreach ($limitedJobs as $job)
                                                    <span class="inline-block px-2 py-1 border rounded text-xs">
                                                        {{ is_array($job) ? $job['value'] ?? $job : $job }}
                                                    </span>
                                                @endforeach

                                                @if (count($jobs) > 3)
                                                    <span class="text-xs text-gray-500">+{{ count($jobs) - 3 }}</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <x-filament::icon icon="heroicon-o-document-text"
                            class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun historique</h3>
                        <p class="text-gray-500 mb-6">
                            Les modifications apparaîtront ici après votre première sauvegarde.
                        </p>
                        <x-filament::button wire:click="$set('activeTab', 'edit')" icon="heroicon-o-pencil">
                            Créer la première version
                        </x-filament::button>
                    </div>
                @endif
            </x-filament::section>
        </x-filament::card>

        {{-- modaldétail --}}
        @if ($selectedHistory)
            <x-filament::modal id="history-detail" width="5xl" :heading="'Version du ' . $selectedHistory->created_at->format('d/m/Y à H:i')">

                <div class="space-y-6">


                    <div class=" p-4 rounded-lg">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <div class="text-gray-500">Modifié par</div>
                                <div class="font-medium">{{ $selectedHistory->modified_by }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500">Date</div>
                                <div class="font-medium">{{ $selectedHistory->formatted_date }}</div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-3 pb-2 border-b">
                                <x-filament::icon icon="heroicon-o-archive-box"
                                    class="w-5 h-5 inline mr-2 text-gray-400" />
                                Version sélectionnée
                            </h4>

                            <div class="space-y-4">
                                @foreach (['title_before', 'title_after', 'subtitle', 'cta_text', 'cta_link'] as $field)
                                    <div>
                                        <div class="text-sm font-medium text-gray-500 mb-1">
                                            {{ str_replace('_', ' ', ucfirst($field)) }}
                                        </div>
                                        <div class="p-3  rounded border">
                                            {{ $selectedHistory->getDataValue($field, 'Non défini') }}
                                        </div>
                                    </div>
                                @endforeach

                                <div>
                                    <div class="text-gray-500 mb-1">Métiers :</div>
                                    <div class="flex flex-wrap gap-1">
                                        @php
                                            $jobsData = $selectedHistory->getDataValue('jobs', []);

                                            if (is_string($jobsData)) {
                                                $jobsData = json_decode($jobsData, true) ?? [];
                                            }

                                            $jobs = is_array($jobsData) ? $jobsData : [];
                                        @endphp

                                        @if (count($jobs) > 0)
                                            @foreach ($jobs as $job)
                                                <span class="inline-block px-2 py-1 rounded text-xs ">
                                                    {{ is_array($job) ? $job['value'] ?? $job : $job }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-400 text-xs">Aucun métier</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- <div>
                            <h4 class="font-medium text-gray-700 mb-3 pb-2 border-b">
                                <x-filament::icon icon="heroicon-o-check-circle"
                                    class="w-5 h-5 inline mr-2 text-green-500" />
                                Version actuelle
                            </h4>

                            <div class="space-y-4">
                                @foreach (['title_before', 'title_after', 'subtitle', 'cta_text', 'cta_link'] as $field)
                                    <div>
                                        <div class="text-sm font-medium text-gray-500 mb-1">
                                            {{ str_replace('_', ' ', ucfirst($field)) }}
                                        </div>
                                        <div
                                            class="p-3 rounded border
                                            {{ $current->$field !== $selectedHistory->getDataValue($field) ? 'bg-green-50 border-green-200' : 'bg-gray-50' }}">
                                            {{ $current->$field }}
                                            @if ($current->$field !== $selectedHistory->getDataValue($field))
                                                <div class="text-xs text-green-600 mt-1">
                                                    <x-filament::icon icon="heroicon-o-arrow-trending-up"
                                                        class="w-3 h-3 inline mr-1" />
                                                    Modifié
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <div>
                                    <div class="text-sm font-medium text-gray-500 mb-1">Métiers actuels</div>
                                    <div
                                        class="p-3 rounded border
                                        {{ json_encode($this->jobsArray) !== json_encode($selectedHistory->getDataValue('jobs', []))
                                            ? 'bg-green-50 border-green-200'
                                            : 'bg-gray-50' }}">
                                        @foreach ($this->jobsArray as $job)
                                            <span
                                                class="inline-block px-3 py-1 rounded-full text-sm
                                                {{ json_encode($this->jobsArray) !== json_encode($selectedHistory->getDataValue('jobs', []))
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-gray-200' }}">
                                                {{ $job['value'] ?? $job }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>


                    <div class="flex justify-between items-center pt-6 border-t">
                        <div class="text-sm text-gray-500">
                            Version ID: #{{ $selectedHistory->id }}
                        </div>
                        <div class="flex gap-3">
                            <x-filament::button color="gray"
                                wire:click="$dispatch('close-modal', { id: 'history-detail' })"
                                icon="heroicon-o-x-mark">
                                Fermer
                            </x-filament::button>

                            <x-filament::button color="warning" wire:click="restoreHistory" icon="heroicon-o-arrow-path"
                                wire:confirm="Êtes-vous sûr de vouloir restaurer cette version ?">
                                Restaurer cette version
                            </x-filament::button>
                        </div>
                    </div>

                </div>
            </x-filament::modal>
        @endif
    @endif

</x-filament-panels::page>
