@if(!Auth::guest() && (Auth::user()->hasRole("Administrador_ejecucion") || Auth::user()->can("ejecucion_fiscal")) )

    <li class="dropdown @if(Request::is('ejecucion/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Ejecución Fiscal <b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu">

            <li class="@if(Request::is('ejecucion/inicio')) active @endif">
                <a href="{{URL::to('ejecucion/inicio')}}">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                   Carta Invitación
                </a>
            </li>

            <li class="@if(Request::is('ejecucion/Seguimiento')) active @endif">
                <a href="{{URL::to('ejecucion/seguimiento')}}">
                <i class="glyphicon glyphicon-lock"></i>&nbsp;
                    Seguimiento Ejecución
                </a>
            </li>
            
             <li class="@if(Request::is('ejecucion/cargaEjecucion')) active @endif">
                <a href="{{URL::to('ejecucion/cargaEjecucion')}}">
                <i class="glyphicon glyphicon-open"></i>&nbsp;
                    Carta invitación masiva
                </a>
            </li>

            <li class="divider"></li>

             <li class="@if(Request::is('catalogo')) active @endif">
                <a href="{{URL::to('catalogos/ejecutores')}}">
                <i class="glyphicon glyphicon-user"></i>&nbsp;
                    Personal de Ejecución Fiscal
                </a>
            </li>
            
                <li class="@if(Request::is('catalago')) active @endif">
                <a href="{{URL::to('catalogos/salario')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                    Salario Mínimo
                </a>
            </li>

            <li class="@if(Request::is('catalago')) active @endif">
                <a href="{{URL::to('catalogos/inpc')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                    Índice de Precios
                </a>
            </li>

            <li class="@if(Request::is('catalago')) active @endif">
                <a href="{{URL::to('catalogos/status')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                   Status Ejecución
                </a>
            </li>
            
            <li class="@if(Request::is('catalago')) active @endif">
                <a href="{{URL::to('catalogos/configuracion')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                    Configuracion Municipal
                </a>
            </li>

        </ul>
    </li>

@endif