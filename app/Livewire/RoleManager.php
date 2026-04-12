<?php

namespace App\Livewire;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RoleManager extends Component
{
    use WithPagination;

    private const PAGINATION_PAGE_NAME = 'rolesPage';

    /** @var list<string> */
    public const OPCIONES_ADMINISTRADOR = ['Coordinador', 'Home', 'Soporte'];

    /** @var list<string> */
    public const OPCIONES_REPRESENTANTE = ['Home', 'Dashboard'];

    public ?int $editingId = null;

    /** @var array<int, string> */
    public array $administrador = [];

    /** @var array<int, string> */
    public array $representante = [];

    public string $successMessage = '';

    public ?int $confirmingDeleteId = null;

    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function rules(): array
    {
        return (new RoleRequest)->rules();
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $role = Role::findOrFail($id);

        $this->editingId = $role->id;
        $this->administrador = $this->normalizeArray($role->administrador);
        $this->representante = $this->normalizeArray($role->representante);

        $this->successMessage = '';
        $this->confirmingDeleteId = null;
        $this->resetErrorBag();
        $this->broadcastTomSelectState();
    }

    public function save(): void
    {
        $this->validate();

        $payload = [
            'administrador' => array_values(array_unique($this->administrador)),
            'representante' => array_values(array_unique($this->representante)),
        ];

        if ($this->editingId !== null) {
            Role::findOrFail($this->editingId)->update($payload);
            $this->successMessage = __('Role updated successfully.');
        } else {
            Role::create($payload);
            $this->successMessage = __('Role created successfully.');
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
        Role::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->clearFormFields();
        }

        $this->confirmingDeleteId = null;
        $this->successMessage = __('Role deleted successfully.');
        $this->resetPage(self::PAGINATION_PAGE_NAME);
    }

    protected function clearFormFields(): void
    {
        $this->editingId = null;
        $this->reset(['administrador', 'representante']);
        $this->administrador = [];
        $this->representante = [];
        $this->resetValidation();
        $this->broadcastTomSelectState();
    }

    protected function broadcastTomSelectState(): void
    {
        $this->dispatch('role-ts-sync', administrador: array_values($this->administrador), representante: array_values($this->representante));
    }

    public function syncTomSelectBrowser(): void
    {
        $this->broadcastTomSelectState();
    }

    protected function resetForm(): void
    {
        $this->confirmingDeleteId = null;
        $this->successMessage = '';
        $this->clearFormFields();
    }

    /**
     * @param  mixed  $value
     * @return array<int, string>
     */
    protected function normalizeArray(mixed $value): array
    {
        if (! is_array($value)) {
            return [];
        }

        return array_values(array_filter($value, static fn ($v) => is_string($v) && $v !== ''));
    }

    public static function etiquetasLista(?array $items): string
    {
        if ($items === null || $items === []) {
            return '—';
        }

        return implode(', ', $items);
    }

    public function render()
    {
        $query = Role::query()->orderByDesc('id');

        if ($this->search !== '') {
            $term = '%'.addcslashes($this->search, '%_\\').'%';
            $driver = DB::connection()->getDriverName();
            if ($driver === 'mysql' || $driver === 'mariadb') {
                $needle = mb_strtolower($term, 'UTF-8');
                $query->where(function ($q) use ($needle) {
                    $q->whereRaw('LOWER(CAST(`administrador` AS CHAR)) like ?', [$needle])
                        ->orWhereRaw('LOWER(CAST(`representante` AS CHAR)) like ?', [$needle]);
                });
            } else {
                $query->where(function ($q) use ($term) {
                    $q->where('id', 'like', $term);
                });
            }
        }

        return view('livewire.role-manager', [
            'roles' => $query->paginate(20, ['*'], self::PAGINATION_PAGE_NAME),
        ]);
    }
}
