<?php

namespace App\Livewire;

use App\Http\Requests\CargoRequest;
use App\Models\Cargo;
use Livewire\Component;
use Livewire\WithPagination;

class CargoManager extends Component
{
    use WithPagination;

    private const PAGINATION_PAGE_NAME = 'cargosPage';

    public ?int $editingId = null;

    public string $nombre = '';

    public string $prefijo = '';

    public string $successMessage = '';

    public ?int $confirmingDeleteId = null;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function rules(): array
    {
        return (new CargoRequest)->rules();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $cargo = Cargo::findOrFail($id);

        $this->editingId = $cargo->id;
        $this->nombre = $cargo->nombre;
        $this->prefijo = $cargo->prefijo;

        $this->successMessage = '';
        $this->confirmingDeleteId = null;
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $payload = [
            'nombre' => $this->nombre,
            'prefijo' => $this->prefijo,
        ];

        if ($this->editingId !== null) {
            Cargo::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Cargo updated successfully.');
        } else {
            Cargo::create($payload);
            $this->successMessage = __('Cargo created successfully.');
        }

        $this->clearFormFields();
        $this->resetPage(self::PAGINATION_PAGE_NAME);
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
        Cargo::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Cargo deleted successfully.');
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['nombre', 'prefijo']);
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
        $query = Cargo::query()->orderByDesc('id');

        if ($this->search !== '') {
            $term = '%'.addcslashes($this->search, '%_\\').'%';
            $query->where(function ($q) use ($term) {
                $q->where('nombre', 'like', $term)
                    ->orWhere('prefijo', 'like', $term);
            });
        }

        return view('livewire.cargo-manager', [
            'cargos' => $query->paginate(20, ['*'], self::PAGINATION_PAGE_NAME),
        ]);
    }
}
