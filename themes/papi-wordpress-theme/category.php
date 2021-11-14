<!doctype html>
<html <?php language_attributes(); ?>>
  
    <?php get_template_part( 'parts/head' ); ?>


    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
    
            <main>
                <?php get_template_part( 'parts/logo_header' ); ?>
                <?php get_template_part( 'parts/menu' ); ?>

                <div class="container my-5">
                    <?php
                        $category = get_category( get_query_var( 'cat' ) );
                        $the_query = new WP_Query( array(
                            'category_name'   => $category->slug,
                            'paged'           => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
                            'posts_per_page'  => 5
                        ) );

                        $category_have_posts = $the_query->have_posts();

                        if ( $category_have_posts ) {
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $thumbnail_url = get_the_post_thumbnail_url();
                                $has_thumbnail = strlen($thumbnail_url) != 0;
                                echo '<article>
                                    <h1 class="hello">' . get_the_title() . '</h1>
                                    <h2>' . get_the_date() . '</h2>' . 
                                    '<div>' .
                                        ($has_thumbnail 
                                        ? '<div 
                                            class="article-logo" 
                                            style="background-image: url(\''. $thumbnail_url . '\')"
                                            ></div>' : '') .
                                        '<p>' . get_the_excerpt() . '</p>
                                        <a href="' . get_the_permalink() . '">Lire »</a>
                                    </div>                             
                                </article>
                                <hr class="col-3 col-md-2 mb-5">';
                            }
                        } else {
                            echo '<article>
                                <h1>Pas d\'article</h1>
                                <p>Cette catégorie ne contient pas d\'articles à afficher... pour le moment :)</p>
                            </article>';
                        }
                    ?>
                </div>

                <?php
                    if ($category_have_posts) {
                        echo '<div class="container" style="height: 50px">
                        <div class="row">
                          <div class="col-sm d-flex justify-content-center">' . 
                            get_previous_posts_link('« Articles plus récents') .
                         '</div>
                          <div class="col-sm"></div>
                          <div class="col-sm d-flex justify-content-center">'
                            . get_next_posts_link('Articles plus anciens »') .
                          '</div>
                        </div>
                      </div>';
                    }
                ?>
            </main>

         <?php get_template_part( 'parts/footer' ); ?>
      
    </body>
</html>
