<?php

namespace App\Http\Livewire\Clients;

use Livewire\Component;
use App\Models\contactoCliente;
use Illuminate\Support\Facades\Crypt;

class Contacts extends Component
{
    public $nombre,
        $telefono, $email,
        $cargo, $successMessage, $searchTerm, $dataContact, $clientId, $countContacts, $contactId, $actionMessage, $EditContacto;

    protected $rules = [
        'nombre' => 'required|min:3',
        'email' => 'required|min:3',
        'telefono' => 'required|min:7',
        'cargo' => 'required|min:3',
    ];

    public function render()
    {
        $this->dataContact = contactoCliente::when($this->searchTerm, function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('telephone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('position', 'like', '%' . $this->searchTerm . '%');
            });
        })
            ->where('id_cliente', '=', $this->clientId)
            ->whereNotNull('id_cliente')
            ->select('id','name', 'email', 'telephone', 'position')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.clients.contacts');
    }

    protected $messages = [
        'nombre.required' => 'Debe ingresar un nombre válido.',
        'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
        'email.required' => 'Debe ingresar un correo electrónico válido.',
        'email.min' => 'El correo electrónico debe tener al menos 3 caracteres.',
        'telefono.required' => 'Debe ingresar un teléfono válido.',
        'telefono.min' => 'El teléfono debe tener al menos 7 caracteres.',
        'cargo.required' => 'Debe ingresar un cargo válido.',
        'cargo.min' => 'El cargo debe tener al menos 3 caracteres.',
    ];
    public function mount($idCliente = null)
    {
        $this->clientId = $idCliente;
        $this->dataContact = contactoCliente::select('id','name', 'telephone', 'email', 'position', 'id_cliente')->where('id_cliente', '=', $this->clientId)->get();
    }
    public function submitClient()
    {
        $this->validate();
        $contact = new contactoCliente();
        $contact->name = $this->nombre;
        $contact->email = $this->email;
        $contact->telephone = $this->telefono;
        $contact->position = $this->cargo;
        $contact->id_cliente = $this->clientId;
        $contact->save();
        $this->successMessage = "El contacto ha sido creado satisfactoriamente";
        $this->clearInputs();
    }

    public function updateClient()
    {
        $contactUpdate = contactoCliente::findOrFail($this->contactId);
        $contactUpdate->name = $this->nombre;
        $contactUpdate->email = $this->email;
        $contactUpdate->telephone = $this->telefono;
        $contactUpdate->position = $this->cargo;
        $contactUpdate->id_cliente = $this->clientId;
        $contactUpdate->save();
        $this->successMessage = "El contacto ha sido actualizado satisfactoriamente";
        $this->clearInputs();
    }
    public function closeMessage()
    {
        $this->successMessage = '';
        $this->actionMessage = '';
    }
    public function clearInputs()
    {
        $this->nombre = null;
        $this->email = null;
        $this->telefono = null;
        $this->cargo = null;
        $this->resetValues();
    }

    public function encryptId($id)
    {
        $encryptedId = Crypt::encrypt($id);
        return $encryptedId;
    }

    public function decryptId($id)
    {
        $decryptedId = Crypt::decrypt($id);
        return $decryptedId;
    }
    public function edit($id)
    {
        $this->contactId = $this->decryptId($id);
        if ($this->contactId != null) {
            $this->EditContacto = contactoCliente::where('id', '=', $this->contactId)->first();
            $this->nombre = $this->EditContacto->name;
            $this->email = $this->EditContacto->email;
            $this->telefono = $this->EditContacto->telephone;
            $this->cargo = $this->EditContacto->position;
        } else {
            $this->actionMessage = "Error con el id del usuario";
        }
    }

    public function drop($id)
    {
        $this->contactId = $this->decryptId($id);
        if ($this->contactId != null) {
            $contactoEliminar = contactoCliente::where('id', '=', $this->contactId);
            $contactoEliminar->delete();
            $this->actionMessage = "Equipo eliminado correctamente";
            $this->clearInputs();
        } else {
            $this->actionMessage = "Error con el id del usuario";
        }
    }
    public function resetValues()
    {
        $this->contactId = null;
        $this->EditContacto = null;
    }
}
