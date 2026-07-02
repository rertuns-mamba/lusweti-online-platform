<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Cube;

class HoverCube extends Component
{
    public array $cube;

    public function mount()
    {
        // Fetch the first cube from the DB
        $cubeRecord = Cube::first();

        // If it exists, convert to array. If null, use default values.
        $this->cube = $cubeRecord ? $cubeRecord->toArray() : [
            'front' => 'Front',
            'back' => 'Back',
            'right' => 'Right',
            'left' => 'Left',
            'top' => 'Top',
            'bottom' => 'Bottom',
        ];
    }

    // Listen to Laravel Reverb on the 'cube-updates' channel
    #[On('echo:cube-updates,CubeUpdated')]
    public function updateCubeFaces($event)
    {
        // Reverb sends the serialized event payload
        $this->cube = $event['cube'];
    }

    public function render()
    {
        return view('livewire.hover-cube');
    }
}