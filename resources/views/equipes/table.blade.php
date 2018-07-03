<table class="table table-responsive" id="equipes-table">
    <thead>
        <tr>
            <th>Nome</th>
        <th>Imagem</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equipes as $equipe)
        <tr>
            <td>{!! $equipe->nome !!}</td>
            <td>{!! $equipe->imagem !!}</td>
            <td>
                {!! Form::open(['route' => ['equipes.destroy', $equipe->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('equipes.show', [$equipe->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('equipes.edit', [$equipe->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>