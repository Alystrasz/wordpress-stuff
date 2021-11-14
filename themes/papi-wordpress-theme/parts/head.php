<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <?php 
        echo "<style>
        .header-bg {
            background: url(" . get_theme_mod('papi_background_header_image') . ");
        }
        </style>";
    ?>

    <?php wp_head() ?>
</head>