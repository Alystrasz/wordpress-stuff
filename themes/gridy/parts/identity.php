<div
    class="<?php
            echo isset($hideOnMobile) && $hideOnMobile ? 'd-none d-lg-flex' : 'd-flex'
        ?> col justify-content-center align-items-center h-100 col-12 col-sm-12 col-lg-5 col-xl-6"
>
    <div class="presentation text-center">
        <img
                class="col col-lg-8"
                src="<?php echo get_theme_mod('gridy_identity_logo'); ?>"
                alt="identity logo"
        />
        <?php echo get_theme_mod('gridy_identity_text'); ?>
    </div>
</div>
