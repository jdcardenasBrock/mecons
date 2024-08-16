<?php

namespace App\Http\Livewire\Clients;

use Livewire\WithPagination;
use App\Models\equipoCliente;
use Livewire\Component;

class EquipmentGeneral extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingperPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = equipoCliente::with('client')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('modelo', 'like', '%' . $this->search . '%')
                        ->orWhere('marca', 'like', '%' . $this->search . '%')
                        ->orWhere('modelo', 'like', '%' . $this->search . '%')
                        ->orWhere('serial', 'like', '%' . $this->search . '%')
                        ->orWhere('numero_interno', 'like', '%' . $this->search . '%')
                        ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
                }
            })
            ->orWhereHas('client', function ($query) {
                if ($this->search) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                }
            })
            ->orderBy('id_cliente')
            ->paginate($this->perPage);

        return view('livewire.clients.equipment-general', [
            'items' => $items,
        ]);
    }
}
