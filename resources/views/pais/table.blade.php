<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>No</th>

                <th>Prefijo</th>
                <th>Nombre</th>
                <th>Coordena</th>
                <th>Zoom</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pais as $pai)
                <tr>
                    <td>{{ ++$i }}</td>

                    <td>{{ $pai->prefijo }}</td>
                    <td>{{ $pai->nombre }}</td>
                    <td>{{ $pai->coordena }}</td>
                    <td>{{ $pai->zoom }}</td>

                    <td>
                        <form action="{{ route('pais.destroy',$pai->id) }}" method="POST">
                            <a class="btn btn-sm btn-primary " href="{{ route('pais.show',$pai->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                            <a class="btn btn-sm btn-success" href="{{ route('pais.edit',$pai->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
