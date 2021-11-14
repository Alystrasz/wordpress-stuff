<!doctype html>
<html <?php language_attributes(); ?>>
  
    <?php get_template_part( 'parts/head' ); ?>


    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
    
            <main>
                <?php get_template_part( 'parts/logo_header' ); ?>
                <?php get_template_part( 'parts/menu' ); ?>

                <div class="container my-5">
                    <h1 class="display-4 py-5 d-flex justify-content-center">
                        Cette page n'existe pas. Oups !
                    </h1>
                </div>
            </main>

         <?php get_template_part( 'parts/footer' ); ?>
      
    </body>
</html>
