<?php 

namespace App\Livewire\Frontend;

use App\Models\SidebarWidget;
use Livewire\Component;

class SidebarRenderer extends Component
{
    public $categoryId;

    public function mount($categoryId = null)
    {
        $this->categoryId = $categoryId;
    }

    public function render()
    {
        // Real-time: The query runs every 60 seconds automatically
        return view('livewire.frontend.sidebar-renderer', [
            'widgets' => SidebarWidget::forCategory($this->categoryId)->get()
        ]);
    }
}