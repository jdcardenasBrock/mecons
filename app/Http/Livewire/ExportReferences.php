<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExportReferences extends Component
{
    public $progress = 0;
    public $exporting = false;
    public $exportFinished = false;

    protected $listeners = ['updateProgress'];

    public function startExport()
    {
        $this->exporting = true;
        $this->progress = 0;
        $this->exportFinished = false;

        $this->dispatchBrowserEvent('start-export');
    }

    public function updateProgress($progress)
    {
        $this->progress = $progress;

        if ($progress >= 100) {
            $this->exporting = false;
            $this->exportFinished = true;
        }
    }

    public function render()
    {
        return view('livewire.export-references');
    }
}
