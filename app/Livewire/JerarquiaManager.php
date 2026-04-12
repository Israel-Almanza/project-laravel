<?php

namespace App\Livewire;

use App\Http\Requests\JerarquiaRequest;
use App\Models\Jerarquia;
use Livewire\Component;
use Livewire\WithPagination;

class JerarquiaManager extends Component
{
    use WithPagination;

    private const PAGINATION_PAGE_NAME = 'jerarquiasPage';

    public ?int $editingId = null;

    public string $prefijo = '';

    public string $organizacion = '';

    public string $successMessage = '';

    public ?int $confirmingDeleteId = null;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function rules(): array
    {
        return (new JerarquiaRequest)->rules();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $jerarquia = Jerarquia::findOrFail($id);

        $this->editingId = $jerarquia->id;
        $this->prefijo = $jerarquia->prefijo;
        $this->organizacion = $jerarquia->organizacion;

        $this->successMessage = '';
        $this->confirmingDeleteId = null;
        $this->resetErrorBag();
    }

    public function save(): void
    {
        $this->validate();

        $payload = [
            'prefijo' => $this->prefijo,
            'organizacion' => $this->organizacion,
        ];

        if ($this->editingId !== null) {
            Jerarquia::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Jerarquía actualizada correctamente.');
        } else {
            Jerarquia::create($payload);
            $this->successMessage = __('Jerarquía creada correctamente.');
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
        Jerarquia::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Jerarquía eliminada correctamente.');
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['prefijo', 'organizacion']);
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
        $query = Jerarquia::query()->orderByDesc('id');

        if ($this->search !== '') {
            $term = '%'.addcslashes($this->search, '%_\\').'%';
            $query->where(function ($q) use ($term) {
                $q->where('prefijo', 'like', $term)
                    ->orWhere('organizacion', 'like', $term);
            });
        }

        return view('livewire.jerarquia-manager', [
            'jerarquias' => $query->paginate(20, ['*'], self::PAGINATION_PAGE_NAME),
        ]);
    }
}
