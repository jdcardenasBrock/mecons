<?php

namespace App\Http\Livewire\Lists;

use Livewire\Component;

class SurveyView extends Component
{
    public $vista = 'lista';
    public $coleccion;

    public function mount($collection)
    {
        $this->coleccion =$collection;
    }

    public function cambiarVista($nuevaVista)
    {
        $this->vista = $nuevaVista;
    }
    public function render()
    {
        return view('livewire.lists.survey-view');
    }
}
