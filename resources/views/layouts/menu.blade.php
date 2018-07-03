<li class="{{ Request::is('cursos*') ? 'active' : '' }}">
    <a href="{!! route('cursos.index') !!}"><i class="fa fa-edit"></i><span>Cursos</span></a>
</li>

<li class="{{ Request::is('equipes*') ? 'active' : '' }}">
    <a href="{!! route('equipes.index') !!}"><i class="fa fa-edit"></i><span>Equipes</span></a>
</li>

