

    <div class="sidebar">
            
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu = 0"  class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Mantenimiento
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Registro Bus</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu = 1"  class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Marca</a>
                            </li>
                            <li  @click="menu = 2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Bus</a>
                            </li>
                              <li  @click="menu = 3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-bag"></i> Conductor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-briefcase"></i> Registro de Viajes</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu = 4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-briefcase"></i>Viaje</a>
                            </li>
                            <li @click="menu = 5"  class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-briefcase"></i>Ruta</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-basket"></i> Ventas</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu = 7"  class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-basket-loaded"></i> Ventas</a>
                            </li>
                            <li @click="menu = 8"  class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Clientes</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu = 9"  class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li  @click="menu = 10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
            
        </div>  
