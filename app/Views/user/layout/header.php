<nav class="navbar is-link">
    <div class="navbar-brand">
        <a class="navbar-item" href="http://CT.test/">
            <img src="/assets/img/DigiTechLogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112"
                height="28">
        </a>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu is-right">
        <div class="navbar-start">
            <a class="navbar-item <?=service('request')->uri->getPath() == 'user/home' ? 'is-active' : '' ?>"
                href="<?=base_url(route_to('user'))?>">
                <span class="icon"><i class="fas fa-file-alt" aria-hidden="true"></i></span>
                <span>Mis incidencias</span>
            </a>

            <a class="navbar-item <?=service('request')->uri->getPath() == '' ? 'is-active' : '' ?>"
                href="<?=base_url(route_to('user'))?>">
                <span class="icon"><i class="fa fa-chart-column" aria-hidden="true"></i></span>
                <span>Reportes</span>
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <span class="icon"><i class="fa fa-cog"></i></span>
                    <span>Configuración</span>
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item <?=service('request')->uri->getPath() == 'user/perfil' ? 'is-active' : '' ?>"
                        href="<?=base_url(route_to('perfilUser'))?>">
                        <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                        <span> Mi perfil</span>
                    </a>
                    <a class="navbar-item <?=service('request')->uri->getPath() == 'user/actualizar-perfil' ? 'is-active' : '' ?>"
                        href="<?=base_url(route_to('updatePerfilUser'))?>">
                        <span class="icon"><i class="fas fa-user-cog" aria-hidden="true"></i></span>
                        <span>Actualizar</span>
                    </a>
                </div>
            </div>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field is-grouped">
                    <p class="control">
                        <a class="button is-link has-text-black is-boxed" href="<?=base_url(route_to('logoutU'))?>">
                            <span class="has-text-white">Cerrar sesión</span>
                            <span class="icon has-text-white"><i class="fas fa-sign-out-alt"></i></span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
</nav>