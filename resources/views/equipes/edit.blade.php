@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Equipe
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($equipe, ['route' => ['equipes.update', $equipe->id], 'method' => 'patch']) !!}

                        @include('equipes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection