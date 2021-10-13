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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
      <?php wp_head() ?>
  </head>

  <body <?php body_class(); ?> data-barba="wrapper">
  <?php wp_body_open(); ?>
    <div class="main-wrapper row align-items-center no-gutters h-100">

      <!-- left column, with logo and description -->
      <?php get_template_part( 'parts/identity' ); ?>

      <!-- right column, with content -->
      <div
              data-barba="container" data-barba-namespace="home"
              class="col content h-100 col-12 col-sm-12 col-lg-7 col-xl-6"
      >

        <!-- projects slider -->
        <div class="row h-50 no-gutters articles-container text-center">
            <?php
                $catObj = get_category_by_slug(get_theme_mod('gridy_homepage_highlight_category'));
                $catId = $catObj->term_id;
                $articles = get_posts( array ( 'category' =>  $catId) );
            ?>
          <a class="articles-images-link" href="<?php echo get_category_link($catObj) ?>">
            <div class="articles-images-label"><?php echo get_theme_mod('gridy_homepage_highlight_link_text') ?></div>
            <div class="articles-images-slider row no-gutters">
                <?php
                    foreach ($articles as $article) {
                        echo
                            '<div style="background-image: url(\'' . get_the_post_thumbnail_url($article->ID,'full') . '\')"></div>';
                    }
                ?>
            </div>
          </a>
        </div>

        <!-- bottom-right container -->
        <div class="row h-50 no-gutters">

          <!-- articles-texts card  -->
          <div class="col col-12 col-sm-6 col-md-6 articles-texts category-content">
            <h2>
                <?php
                    $catObj = get_category_by_slug(get_theme_mod('gridy_homepage_featured_category'));
                    echo $catObj->name;
                ?>
            </h2>
            <div class="articles-texts-slider">
                <?php
                    $catObj = get_category_by_slug(get_theme_mod('gridy_homepage_featured_category'));
                    $catId = $catObj->term_id;
                    $articles = get_posts( array ( 'numberposts' => 4, 'category' =>  $catId) );

                    foreach ($articles as $article) {
                        echo
                            '<article>
                                <h1>' . get_the_title($article) . '</h1>
                                <p>' . get_the_excerpt($article) . '</p>
                                <a class="category-content-link" href="' . get_permalink($article) . '">Read</a>
                            </article>';
                    }
                ?>
            </div>
          </div>

          <div class="col col-12 col-sm-6 col-md-6 content h-100">
            <!-- featured-article card -->
            <div class="row no-gutters category-content featured-article">
              <h2>Latest article</h2>
              <article>
                  <?php
                      $recent_posts = get_posts( array( 'numberposts' => '1') );
                      $post = $recent_posts[0];
                  ?>
                <h1>
                  <a href="<?php echo get_permalink($post)?>"><?php echo get_the_title($post) ?></a>
                </h1>
                <p>
                  <?php echo get_the_excerpt($post); ?>
                </p>
                <a
                        class="category-content-link"
                        href="<?php
                            $arr = get_the_category($post->ID);
                            $cat = null;
                            if (is_array($arr)) {
                                foreach ($arr as $curCat) {
                                    if ($cat == null && $curCat->cat_ID != 1) {   // not picking unsorted category
                                        $cat = $curCat;
                                    }
                                }
                            } else {
                                $cat = $arr;
                            }

                            echo get_category_link($cat);
                        ?>
                        "
                >
                    Linked articles
                </a>
              </article>
            </div>

            <!-- contact links -->
            <div class="row no-gutters contact text-center align-items-center">
              <div class="contact-list align-items-center">
                <a href="https://github.com/Alystrasz" target="_blank"><i class="bi bi-github"></i></a>
                <a href="https://www.linkedin.com/in/remy-raes/" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="mailto:contact@remyraes.com" target="_blank"><i class="bi bi-envelope"></i></a>
              </div>
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
