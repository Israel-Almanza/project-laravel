<?php

namespace App\Livewire;

use App\Http\Requests\MunicipioRequest;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class MunicipioManager extends Component
{
    use WithPagination;

    protected $listeners = [
        'dataUpdated' => 'refreshData',
    ];

    private const PAGINATION_PAGE_NAME = 'municipiosPage';

    public ?int $editingId = null;

    public string $prefijo = '';

    public string $nombre = '';

    /** @var array<int|string, string> */
    public array $paises = [];

    /** @var array<int|string, string> */
    public array $departamentos = [];

    /** @var array<int|string, string> */
    public array $provincias = [];

    public ?int $pais_id = null;

    public ?int $departamento_id = null;

    public ?int $provincia_id = null;

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

        $this->syncProvinciaWithHierarchy();
    }

    public function updatedDepartamentoId(mixed $value): void
    {
        if ($value === '' || $value === null) {
            $this->departamento_id = null;
        } else {
            $this->departamento_id = (int) $value;
        }

        $this->syncProvinciaWithHierarchy();
    }

    public function updatedProvinciaId(mixed $value): void
    {
        if ($value === '' || $value === null) {
            $this->provincia_id = null;

            return;
        }

        $this->provincia_id = (int) $value;
    }

    protected function syncProvinciaWithHierarchy(): void
    {
        if ($this->provincia_id === null) {
            return;
        }

        if ($this->pais_id === null || $this->departamento_id === null) {
            $this->provincia_id = null;

            return;
        }

        $valid = Provincia::query()
            ->where('id', $this->provincia_id)
            ->where('departamento_id', $this->departamento_id)
            ->where('pais_id', $this->pais_id)
            ->exists();

        if (! $valid) {
            $this->provincia_id = null;
        }
    }

    public function refreshData(): void
    {
        $this->loadData();
    }

    /**
     * Recarga selects de país / departamento / provincia y valida la jerarquía actual.
     */
    protected function loadData(): void
    {
        $this->loadPaises();
        $this->loadDepartamentos();
        $this->loadProvincias();
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

    protected function loadProvincias(): void
    {
        $this->provincias = Provincia::query()
            ->with(['departamento', 'pais'])
            ->orderBy('nombre')
            ->get()
            ->mapWithKeys(function (Provincia $p) {
                $label = $p->nombre;
                if ($p->departamento) {
                    $label .= ' ('.$p->departamento->nombre.')';
                }

                return [$p->id => $label];
            })
            ->all();
    }

    protected function sanitizeHierarchySelections(): void
    {
        if ($this->pais_id !== null && ! array_key_exists($this->pais_id, $this->paises)) {
            $this->pais_id = null;
            $this->departamento_id = null;
            $this->provincia_id = null;

            return;
        }

        if ($this->departamento_id !== null && ! array_key_exists($this->departamento_id, $this->departamentos)) {
            $this->departamento_id = null;
            $this->provincia_id = null;

            return;
        }

        if ($this->departamento_id !== null) {
            $validDepartamento = Departamento::query()
                ->where('id', $this->departamento_id)
                ->where('pais_id', $this->pais_id)
                ->exists();
            if (! $validDepartamento) {
                $this->departamento_id = null;
                $this->provincia_id = null;

                return;
            }
        }

        if ($this->provincia_id !== null && ! array_key_exists($this->provincia_id, $this->provincias)) {
            $this->provincia_id = null;

            return;
        }

        $this->syncProvinciaWithHierarchy();
    }

    protected function rules(): array
    {
        return array_merge(
            (new MunicipioRequest)->rules(),
            [
                'departamento_id' => [
                    'required',
                    'integer',
                    Rule::exists('departamentos', 'id')->where('pais_id', $this->pais_id),
                ],
                'provincia_id' => [
                    'required',
                    'integer',
                    Rule::exists('provincias', 'id')
                        ->where('departamento_id', $this->departamento_id)
                        ->where('pais_id', $this->pais_id),
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
        $municipio = Municipio::query()->with(['pais', 'departamento', 'provincia'])->findOrFail($id);

        $this->editingId = $municipio->id;
        $this->prefijo = $municipio->prefijo ?? '';
        $this->nombre = $municipio->nombre ?? '';
        $this->pais_id = $municipio->pais_id !== null ? (int) $municipio->pais_id : null;
        $this->departamento_id = $municipio->departamento_id !== null ? (int) $municipio->departamento_id : null;
        $this->provincia_id = $municipio->provincia_id !== null ? (int) $municipio->provincia_id : null;
        $this->coordenadas = $municipio->coordenadas;
        $this->zoom = (string) $municipio->zoom;

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
            'provincia_id' => $this->provincia_id,
            'coordenadas' => $this->coordenadas,
            'zoom' => $this->zoom,
        ];

        if ($this->editingId !== null) {
            Municipio::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Municipio updated successfully.');
        } else {
            Municipio::create($payload);
            $this->successMessage = __('Municipio created successfully.');
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
        Municipio::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Municipio deleted successfully.');
        $this->resetPage(self::PAGINATION_PAGE_NAME);
        $this->loadData();
        $this->dispatch('dataUpdated');
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['prefijo', 'nombre', 'pais_id', 'departamento_id', 'provincia_id', 'coordenadas', 'zoom']);
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
        $query = Municipio::query()
            ->with(['pais', 'departamento', 'provincia'])
            ->orderByDesc('id');

        if ($this->search !== '') {
            $term = '%'.addcslashes($this->search, '%_\\').'%';
            $query->where(function ($q) use ($term) {
                $q->where('prefijo', 'like', $term)
                    ->orWhere('nombre', 'like', $term)
                    ->orWhere('coordenadas', 'like', $term)
                    ->orWhere('zoom', 'like', $term)
                    ->orWhereHas('pais', fn ($pq) => $pq->where('nombre', 'like', $term))
                    ->orWhereHas('departamento', fn ($dq) => $dq->where('nombre', 'like', $term))
                    ->orWhereHas('provincia', fn ($rq) => $rq->where('nombre', 'like', $term));
            });
        }

        return view('livewire.municipio-manager', [
            'municipios' => $query->paginate(20, ['*'], self::PAGINATION_PAGE_NAME),
        ]);
    }
}
