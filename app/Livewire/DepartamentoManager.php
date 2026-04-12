<?php

namespace App\Livewire;

use App\Http\Requests\DepartamentoRequest;
use App\Models\Departamento;
use App\Models\Pais;
use Livewire\Component;
use Livewire\WithPagination;

class DepartamentoManager extends Component
{
    use WithPagination;

    private const PAGINATION_PAGE_NAME = 'departamentosPage';

    public ?int $editingId = null;

    public string $nombre = '';

    /** @var array<int|string, string> id => nombre */
    public array $paises = [];

    public ?int $pais_id = null;

    public string $coordena = '';

    public string $zoom = '';

    public string $successMessage = '';

    public ?int $confirmingDeleteId = null;

    public function mount(): void
    {
        $this->loadPaises();
    }

    public function updatedPaisId(mixed $value): void
    {
        if ($value === '' || $value === null) {
            $this->pais_id = null;

            return;
        }

        $this->pais_id = (int) $value;
    }

    protected function loadPaises(): void
    {
        $this->paises = Pais::query()
            ->orderBy('nombre')
            ->pluck('nombre', 'id')
            ->all();
    }

    protected function rules(): array
    {
        return (new DepartamentoRequest)->rules();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $departamento = Departamento::findOrFail($id);

        $this->editingId = $departamento->id;
        $this->nombre = $departamento->nombre;
        $this->pais_id = $departamento->pais_id !== null ? (int) $departamento->pais_id : null;
        $this->coordena = $departamento->coordena;
        $this->zoom = (string) $departamento->zoom;

        $this->successMessage = '';
        $this->confirmingDeleteId = null;
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $payload = [
            'nombre' => $this->nombre,
            'pais_id' => $this->pais_id,
            'coordena' => $this->coordena,
            'zoom' => $this->zoom,
        ];

        if ($this->editingId !== null) {
            Departamento::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Departamento updated successfully.');
        } else {
            Departamento::create($payload);
            $this->successMessage = __('Departamento created successfully.');
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
        Departamento::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Departamento deleted successfully.');
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['nombre', 'pais_id', 'coordena', 'zoom']);
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
        return view('livewire.departamento-manager', [
            'departamentos' => Departamento::query()
                ->with('pais')
                ->orderByDesc('id')
                ->paginate(20, ['*'], self::PAGINATION_PAGE_NAME),
        ]);
    }
}
