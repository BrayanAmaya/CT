<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<nav class="navbar is-link">
    <div class="navbar-brand">
        <a class="navbar-item" href="http://ct_prueba.test/">
            <img src="/assets/img/DigiTechLogo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112"
                height="28">
        </a>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu is-right">
        <div class="navbar-start">
            <a style=" text-decoration: none;"
                class="navbar-item <?=service('request')->uri->getPath() == 'user/incidencia' ? 'is-active' : '' ?>"
                href="<?=base_url(route_to('user'))?>">
                <span class="icon"><i class="fas fa-file-alt" aria-hidden="true"></i></span>
                <span>Mis incidencias</span>
            </a>

            <a style=" text-decoration: none;"
                class="navbar-item <?=service('request')->uri->getPath() == '' ? 'is-active' : '' ?>"
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
                    <a style=" text-decoration: none;"
                        class="navbar-item <?=service('request')->uri->getPath() == 'user/perfil' ? 'is-active' : '' ?>"
                        href="<?=base_url(route_to('perfilUser'))?>">
                        <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                        <span> Mi perfil</span>
                    </a>
                    <a style=" text-decoration: none;"
                        class="navbar-item <?=service('request')->uri->getPath() == 'user/actualizar-perfil' ? 'is-active' : '' ?>"
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
                        <a style=" text-decoration: none;" class="button is-link has-text-black is-boxed"
                            href="<?=base_url(route_to('logoutU'))?>">
                            <span class="has-text-white">Cerrar sesión</span>
                            <span class="icon has-text-white"><i class="fas fa-sign-out-alt"></i></span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
</nav>