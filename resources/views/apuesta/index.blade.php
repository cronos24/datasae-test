@extends('layouts.app')

@section('template_title')
    Apuesta
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Apuesta') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('apuestas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Ruleta Id</th>
										<th>Valor</th>
										<th>Jugadores Id</th>
										<th>Colores Id</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apuestas as $apuesta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $apuesta->ruleta_id }}</td>
											<td>{{ $apuesta->valor }}</td>
											<td>{{ $apuesta->jugadores_id }}</td>
											<td>{{ $apuesta->colores_id }}</td>
											<td>{{ $apuesta->estado }}</td>

                                            <td>
                                                <form action="{{ route('apuestas.destroy',$apuesta->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('apuestas.show',$apuesta->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('apuestas.edit',$apuesta->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $apuestas->links() !!}
            </div>
        </div>
    </div>
@endsection
