@extends('layouts.app')

@section('template_title')
    Jugadores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
            <h2>Prueba de Programación </h2> 

            <p>Se debe realizar una simulación, la cual consiste en un grupo dinámico de personas jugando a la ruleta. El objetivo es crear un sistema para monitorear una mesa de casino. </p>

            <p style="font-weight: bold;">Competencias:</p>
            <ul>
            <li>Desarrollar una aplicación en php, Javascript o RoR. </li>
            <li>Deben existir vistas que permitan ingresar jugadores, a los cuales se les pueden modificar sus datos, incluyendo cantidad de dinero que poseen, y se deben poder eliminar del sistema (CRUD).</li>
            <li>Los jugadores parten con una cantidad de $10.000 por defecto. </li>
            <li>En cada ronda los jugadores apuestan entre un 8% y 15% del total de dinero que poseen. Si tienen $1.000 o menos, van All In. Si no les queda dinero, no apuestan. </li>
            <li>El modo de apuesta es el siguiente, un jugador puede apostar a Verde, Rojo o Negro con un 2%, 49% y 49% de probabilidad respectivamente. </li>
            <li>Un jugador recupera el doble de lo apostado si acierta su apuesta, cuando ésta sea Rojo o Negro, y recupera 15 veces lo apostado en caso de acertar Verde. En caso de perder la apuesta, no recupera nada. </li>
            <li>La ruleta entrega resultados con la misma probabilidad que los jugadores hacen apuestas, es decir, Verde 2%, Rojo 49% y Negro 49%.</li>
            <li>Cada recarga de la página es una ronda de juego transcurrida, con la apuesta de cada jugador y el resultado de la ruleta.  </li>
            <li>La URL principal de la aplicación debe ser esta vista. </li>
            <li>El diseño no se evaluará. </li>
            <li>Cualquier otra funcionalidad no mencionada se considera en la evaluación, pero no es obligatoria. </li>
            <li>Cualquier cosa no especificada queda a criterio del desarrollador.  </li>
            </ul>
            

            <p style="font-weight: bold;">Deseables (no obligatorias pero consideradas):</p>
            <ul>
                <li>Los jugadores participan de una partida de ruleta automáticamente, cada 3 minutos (a nivel de datos y vista).</li>
                <li>El sistema puede publicarse en algún servidor de producción y proveer el link para ingresar. Pueden usarse servicios gratuitos como Heroku.  </li>
            </ul>
            
            

            <p style="font-weight: bold;">Entrega:</p>
            <ul>
                <li>El proyecto de prueba se debe subir a la cuenta personal de Github.</li>
                <li>El sistema debe correr en un sistema UNIX. Las instrucciones de instalación y ejecución deberán ser subidas al readme del repositorio.</li>
                <li>También se puede crear un vídeo explicativo de la implementación realizada.</li>
            </ul>
            
            
            

            </div>
        </div>
    </div>
@endsection
