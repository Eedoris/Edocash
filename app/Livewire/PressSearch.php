<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PressArticle;

class PressSearch extends Component
{
    use WithPagination;

    public string $search = '';
    public string $category = 'all';

    protected $queryString = ['search', 'category'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function render()
    {
        $articles = PressArticle::query()
            ->when($this->search, function ($q) {
                $q->where(function ($qq) {
                    $qq->where('title', 'like', "%{$this->search}%")
                       ->orWhere('excerpt', 'like', "%{$this->search}%");
                });
            })
            ->when($this->category !== 'all', function ($q) {
                $q->where('category', $this->category);
            })
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('livewire.press-search', compact('articles'));
    }
}
