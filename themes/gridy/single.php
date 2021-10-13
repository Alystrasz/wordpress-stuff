<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,700;1,900&display=swap" rel="stylesheet">

      <!--
      <link rel="stylesheet" href="assets/style/colors.css"/>
    <link rel="stylesheet" href="assets/style/articles.css"/>
    <link rel="stylesheet" href="assets/style/single.css"/>
    <link rel="stylesheet" href="style.css"/>
      -->
      <?php wp_head() ?>
  </head>

  <body <?php body_class(); ?> data-barba="wrapper">
  <?php wp_body_open(); ?>
    <div class="main-wrapper row align-items-center no-gutters h-100">

        <!-- left column, with logo and description -->
        <?php set_query_var( 'hideOnMobile', true ); get_template_part( 'parts/identity' ); ?>

      <!-- right column, with content -->
      <div
              data-barba="container" data-barba-namespace="single"
              class="col content h-100 col-12 col-sm-12 col-lg-7 col-xl-6"
      >
        <?php
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
        ?>
        <a class="articles-wrapper-close" href="<?php echo get_category_link($cat) ?>">
          <i class="bi bi-x"></i>
        </a>
        <div class="articles-wrapper" data-simplebar>
          <div class="single-article-title-container">
              <div
                      class="articles-wrapper-header"
                      style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>')"
              ></div>
            <div class="single-article-title">
                <h1>
                    <?php echo the_title() ?>
                </h1>
                <?php
                $posttags = get_the_tags();
                if ($posttags) {
                    echo '<h2>';

                    $tagNames = array_map(function($tag) {
                        return $tag->name;
                    }, $posttags);
                    echo join(', ', $tagNames);

                    echo '</h2>';
                }
                ?>
            </div>
          </div>

          <div class="single-article-wrapper-content">
            <article>
              <div class="article-content">
                  <?php echo the_content() ?>
              </div>
            </article>
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
