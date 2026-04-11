<?php

namespace App\Livewire;

use App\Http\Requests\PaisRequest;
use App\Models\Pais;
use Livewire\Component;
use Livewire\WithPagination;

class PaisManager extends Component
{
    use WithPagination;

    public ?int $editingId = null;

    public string $prefijo = '';

    public string $nombre = '';

    public string $coordena = '';

    public string $zoom = '';

    public string $successMessage = '';

    public ?int $confirmingDeleteId = null;

    protected function rules(): array
    {
        return (new PaisRequest)->rules();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $pais = Pais::findOrFail($id);

        $this->editingId = $pais->id;
        $this->prefijo = $pais->prefijo;
        $this->nombre = $pais->nombre;
        $this->coordena = $pais->coordena;
        $this->zoom = (string) $pais->zoom;

        $this->successMessage = '';
        $this->confirmingDeleteId = null;
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $payload = [
            'prefijo' => $this->prefijo,
            'nombre' => $this->nombre,
            'coordena' => $this->coordena,
            'zoom' => $this->zoom,
        ];

        if ($this->editingId !== null) {
            Pais::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Pais updated successfully.');
        } else {
            Pais::create($payload);
            $this->successMessage = __('Pais created successfully.');
        }

        $this->clearFormFields();
        $this->resetPage();
    }

    public function askDelete(int $id): void
    {
        $this->confirmingDeleteId = $this->confirmingDeleteId === $id ? null : $id;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
    }

    public function delete(): void
    {
        if ($this->confirmingDeleteId === null) {
            return;
        }

        $id = $this->confirmingDeleteId;
        Pais::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Pais deleted successfully.');
        $this->resetPage();
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['prefijo', 'nombre', 'coordena', 'zoom']);
        $this->resetValidation();
    }

    protected function resetForm(): void
    {
        $this->confirmingDeleteId = null;
        $this->successMessage = '';
        $this->clearFormFields();
    }

    public function render()
    {
        return view('livewire.pais-manager', [
            'paises' => Pais::query()->orderByDesc('id')->paginate(20),
        ]);
    }
}
