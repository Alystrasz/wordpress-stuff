<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,700;1,900&display=swap" rel="stylesheet">
      <?php wp_head() ?>
  </head>

  <body <?php body_class(); ?> data-barba="wrapper">
  <?php wp_body_open(); ?>
    <div class="main-wrapper row align-items-center no-gutters h-100">

      <!-- left column, with logo and description -->
      <?php set_query_var( 'hideOnMobile', true ); get_template_part( 'parts/identity' ); ?>

      <!-- right column, with content -->
      <div
              data-barba="container" data-barba-namespace="category"
              class="col content h-100 col-12 col-sm-12 col-lg-7 col-xl-6"
      >
        <div class="articles-wrapper-title">
            <?php
                $category = get_category( get_query_var( 'cat' ) );
                echo $category->name;
            ?>
        </div>
        <a
           class="articles-wrapper-close"
           href="<?php echo home_url(); ?>"
        >
          <i class="bi bi-x"></i>
        </a>
        <div class="articles-wrapper" data-simplebar>
          <div class="articles-wrapper-header"
               style="background-image: url('<?php echo get_theme_mod('gridy_categories_header_image') ?>')"></div>
          <div class="articles-wrapper-content">
              <?php
                  $the_query = new WP_Query( array(
                      'category_name'   => $category->slug,
                      'paged'           => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
                      // 'posts_per_page'  => 5
                  ) );

                  if ( $the_query->have_posts() ) {
                      while ( $the_query->have_posts() ) {
                          $the_query->the_post();
                          echo '<article>
                                <div 
                                    class="article-logo" 
                                    style="background-image: url(\''. get_the_post_thumbnail_url() . '\')"
                                ></div>
                                <div class="article-content">
                                    <h1>' . get_the_title() . '</h1>
                                    <h2>' . get_the_date() . '</h2>
                                    <p>' . get_the_excerpt() . '</p>
                                    <a 
                                        class="category-content-link" 
                                        href="' . get_the_permalink() . '"
                                    >Read</a>
                                </div>
                            </article>';
                      }
                  } else {
                      echo '<div class="article-content">
                                <br/>
                                <h2>This category features no articles... yet :)</h2>
                            </div>';
                  }
              ?>
            <div class="articles-pagination">
                <?php
                    echo get_previous_posts_link('« Newer articles');
                    echo get_next_posts_link('Older articles »');
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>

      <footer>
          <script src="https://unpkg.com/@barba/core"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
          <?php wp_footer(); ?>
      </footer>
  </body>
</html>
