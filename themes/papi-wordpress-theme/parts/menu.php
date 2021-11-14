<div class="nav-bar-container">
    <!-- Mobile menu -->
    <div class="collapse primary-bg" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">Bienvenue</h4>
                    <p class="text-muted">
                        <?php echo get_theme_mod( 'papi_mobile_menu_text' ) ?>
                    </p>
                </div>
                <div class="mobile-menu navbar-dark col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Navigation</h4>
                    <?php wp_nav_menu( array (
                        'menu_class' => 'navbar-nav',
                        'theme_location' => 'header-menu',
                        'walker' => new WP_Bootstrap_Navwalker(),
                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    )) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main menu, appears on desktop screens -->
    <nav class="navbar navbar-expand-lg navbar-dark primary-bg">
        <div class="container">
              <a draggable="false" href="<?php echo get_home_url() ?>" class="navbar-brand d-flex align-items-center">
                <img draggable="false" src="<?php echo get_theme_mod('papi_menu_logo') ?>"/>
              </a>

            <?php wp_nav_menu( array (
                'menu_class' => 'navbar-nav',
                'container_id' => 'navbar-menu-container',
                'container_class' => 'collapse navbar-collapse justify-content-md-center',
                'theme_location' => 'header-menu',
                'walker' => new WP_Bootstrap_Navwalker(),
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
            )) ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</div>