@if(!Auth::guest() && ( Auth::user()->hasRole("Folios") && !Auth::user()->hasRole("Administrador")))

    <li class="dropdown @if(Request::is('Ejecucion/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Folios <b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu">

            <li class="@if(Request::is('nfolios')) active @endif">
                <a href="{{URL::to('/nfolios')}}">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                    Nuevo Folio
                </a>
            </li>
            
            
            <li class="@if(Request::is('foliosemitidos')) active @endif">
                <a href="{{URL::to('/foliosemitidos')}}">
                <i class="glyphicon glyphicon-lock"></i>&nbsp;
                    Folios Emitidos
                </a>
            </li>
            
			<li class="divider"></li>

            <li class="@if(Request::is('entregafoliosmunicipal')) active @endif">
                <a href="{{URL::to('/entregafoliosmunicipal')}}">
                <i class="glyphicon glyphicon-user"></i>&nbsp;
                    Folios Autorizados
                </a>
            </li>
            
          
            <li class="@if(Request::is('entregafoliosestatal')) active @endif">
                <a href="{{URL::to('/entregafoliosestatal')}}">
                <i class="glyphicon glyphicon-open"></i>&nbsp;
                    Entrega Folios Estatal
                </a>
            </li>

            <li class="divider"></li>


            <li class="@if(Request::is('catalogos/peritos/index')) active @endif">
                <a href="{{URL::to('catalogos/peritos/index')}}">
                <i class="glyphicon glyphicon-user"></i>&nbsp;
                    Peritos
                </a>
            </li>

            <li class="divider"></li>

            <li class="@if(Request::is('/reporteperito')) active @endif">
                <a href="{{URL::to('/reporteperito')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                    Reporte Perito
                </a>
            </li>

            <li class="@if(Request::is('/reportemensual')) active @endif">
                <a href="{{URL::to('/reportemensual')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                    Reporte Mensual
                </a>
            </li>

            <li class="@if(Request::is('/reportetotal')) active @endif">
                <a href="{{URL::to('/reportetotal')}}">
                <i class="glyphicon glyphicon-list-alt"></i>&nbsp;
                    Reporte Total
                </a>
            </li>

            <li class="divider"></li>


            <li class="@if(Request::is('/configuraciones')) active @endif">
                <a href="{{URL::to('/configuraciones')}}">
                <i class="glyphicon glyphicon-tags"></i>&nbsp;
                    Configuracion de Oficios
                </a>
            </li>

        </ul>
    </li>

@endif

@if(!Auth::guest() && ( Auth::user()->hasRole("Folios usuario") && !Auth::user()->hasRole("Administrador")))

    <li class="dropdown @if(Request::is('Ejecucion/*')) active @endif">

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Folios <b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu">

            <li class="@if(Request::is('nfolios')) active @endif">
                <a href="{{URL::to('/nfolios')}}">
                <i class="glyphicon glyphicon-th-list"></i>&nbsp;
                    Nuevo Folio
                </a>
            </li>
            
            
            <li class="@if(Request::is('foliosemitidos')) active @endif">
                <a href="{{URL::to('/foliosemitidos')}}">
                <i class="glyphicon glyphicon-lock"></i>&nbsp;
                    Folios Emitidos
                </a>
            </li>
			<li class="divider"></li>
            <li class="@if(Request::is('entregafoliosestatal')) active @endif">
                <a href="{{URL::to('/entregafoliosestatal')}}">
                <i class="glyphicon glyphicon-open"></i>&nbsp;
                    Entrega Folios Estatal
                </a>
            </li>

            <li class="divider"></li>
        </ul>
    </li>
@endif