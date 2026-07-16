<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;

class BlogSearch extends Component
{
    public string $query = '';

    public function render(): \Illuminate\View\View
    {
        $results = [];

        if (strlen($this->query) >= 2) {
            $results = BlogPost::published()
                ->where(function ($q) {
                    $q->where('title',   'like', '%' . $this->query . '%')
                      ->orWhere('excerpt', 'like', '%' . $this->query . '%');
                })
                ->with('category')
                ->take(5)
                ->get();
        }

        return view('livewire.blog-search', compact('results'));
    }
}
