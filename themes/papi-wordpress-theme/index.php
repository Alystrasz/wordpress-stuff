<!doctype html>
<html <?php language_attributes(); ?>>
  
    <?php get_template_part( 'parts/head' ); ?>


    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
    
            <main>
                <?php get_template_part( 'parts/logo_header' ); ?>
                <?php get_template_part( 'parts/menu' ); ?>

                <div class="container my-5">
                    <h1 class="display-4">
                        <?php echo the_title() ?>
                    </h1>
                </div>

                <div class="container my-5">
                    <?php echo the_content() ?>
                </div>
            </main>

         <?php get_template_part( 'parts/footer' ); ?>
      
    </body>
</html>
