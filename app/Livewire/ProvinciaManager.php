<?php

namespace App\Livewire;

use App\Http\Requests\ProvinciaRequest;
use App\Models\Departamento;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ProvinciaManager extends Component
{
    use WithPagination;

    protected $listeners = [
        'dataUpdated' => 'refreshData',
    ];

    private const PAGINATION_PAGE_NAME = 'provinciasPage';

    public ?int $editingId = null;

    public string $prefijo = '';

    public string $nombre = '';

    /** @var array<int|string, string> */
    public array $paises = [];

    /** @var array<int|string, string> */
    public array $departamentos = [];

    public ?int $pais_id = null;

    public ?int $departamento_id = null;

    public string $coordenadas = '';

    public string $zoom = '';

    public string $successMessage = '';

    public ?int $confirmingDeleteId = null;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    public function mount(): void
    {
        $this->loadData();
    }

    public function updatedPaisId(mixed $value): void
    {
        if ($value === '' || $value === null) {
            $this->pais_id = null;
        } else {
            $this->pais_id = (int) $value;
        }

        if ($this->departamento_id !== null) {
            $valid = Departamento::query()
                ->where('id', $this->departamento_id)
                ->where('pais_id', $this->pais_id)
                ->exists();
            if (! $valid) {
                $this->departamento_id = null;
            }
        }
    }

    public function updatedDepartamentoId(mixed $value): void
    {
        if ($value === '' || $value === null) {
            $this->departamento_id = null;

            return;
        }

        $this->departamento_id = (int) $value;
    }

    public function refreshData(): void
    {
        $this->loadData();
    }

    /**
     * Recarga selects de país / departamento y valida selección frente a la jerarquía actual.
     */
    protected function loadData(): void
    {
        $this->loadPaises();
        $this->loadDepartamentos();
        $this->sanitizeHierarchySelections();
    }

    protected function loadPaises(): void
    {
        $this->paises = Pais::query()
            ->orderBy('nombre')
            ->pluck('nombre', 'id')
            ->all();
    }

    protected function loadDepartamentos(): void
    {
        $this->departamentos = Departamento::query()
            ->with('pais')
            ->orderBy('nombre')
            ->get()
            ->mapWithKeys(function (Departamento $d) {
                $label = $d->nombre;
                if ($d->pais) {
                    $label .= ' ('.$d->pais->nombre.')';
                }

                return [$d->id => $label];
            })
            ->all();
    }

    protected function sanitizeHierarchySelections(): void
    {
        if ($this->pais_id !== null && ! array_key_exists($this->pais_id, $this->paises)) {
            $this->pais_id = null;
            $this->departamento_id = null;

            return;
        }

        if ($this->departamento_id !== null) {
            $valid = Departamento::query()
                ->where('id', $this->departamento_id)
                ->where('pais_id', $this->pais_id)
                ->exists();
            if (! $valid) {
                $this->departamento_id = null;
            }
        }
    }

    protected function rules(): array
    {
        return array_merge(
            (new ProvinciaRequest)->rules(),
            [
                'departamento_id' => [
                    'required',
                    'integer',
                    Rule::exists('departamentos', 'id')->where('pais_id', $this->pais_id),
                ],
            ]
        );
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $provincia = Provincia::query()->with(['pais', 'departamento'])->findOrFail($id);

        $this->editingId = $provincia->id;
        $this->prefijo = $provincia->prefijo ?? '';
        $this->nombre = $provincia->nombre ?? '';
        $this->pais_id = $provincia->pais_id !== null ? (int) $provincia->pais_id : null;
        $this->departamento_id = $provincia->departamento_id !== null ? (int) $provincia->departamento_id : null;
        $this->coordenadas = $provincia->coordenadas;
        $this->zoom = (string) $provincia->zoom;

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
            'pais_id' => $this->pais_id,
            'departamento_id' => $this->departamento_id,
            'coordenadas' => $this->coordenadas,
            'zoom' => $this->zoom,
        ];

        if ($this->editingId !== null) {
            Provincia::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Provincia updated successfully.');
        } else {
            Provincia::create($payload);
            $this->successMessage = __('Provincia created successfully.');
        }

        $this->clearFormFields();
        $this->resetPage(self::PAGINATION_PAGE_NAME);
        $this->loadData();
        $this->dispatch('dataUpdated');
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
        Provincia::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Provincia deleted successfully.');
        $this->resetPage(self::PAGINATION_PAGE_NAME);
        $this->loadData();
        $this->dispatch('dataUpdated');
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['prefijo', 'nombre', 'pais_id', 'departamento_id', 'coordenadas', 'zoom']);
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
        $query = Provincia::query()
            ->with(['pais', 'departamento'])
            ->orderByDesc('id');

        if ($this->search !== '') {
            $term = '%'.addcslashes($this->search, '%_\\').'%';
            $query->where(function ($q) use ($term) {
                $q->where('prefijo', 'like', $term)
                    ->orWhere('nombre', 'like', $term)
                    ->orWhere('coordenadas', 'like', $term)
                    ->orWhere('zoom', 'like', $term)
                    ->orWhereHas('pais', function ($pq) use ($term) {
                        $pq->where('nombre', 'like', $term);
                    })
                    ->orWhereHas('departamento', function ($dq) use ($term) {
                        $dq->where('nombre', 'like', $term);
                    });
            });
        }

        return view('livewire.provincia-manager', [
            'provincias' => $query->paginate(20, ['*'], self::PAGINATION_PAGE_NAME),
        ]);
    }
}
