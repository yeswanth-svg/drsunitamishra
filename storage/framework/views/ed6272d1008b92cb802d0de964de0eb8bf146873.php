<nav class="navbar navbar-area navbar-expand-lg nav-style-01 home-variant-<?php echo e($home_variant_number); ?>">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper">
                <a href="<?php echo e(route('homepage')); ?>" class="logo">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                </a>
            </div>
            <div class="mobile-cart"><a href="<?php echo e(route('frontend.products.cart')); ?>"><i class="<?php echo e(get_static_option('shopping_cart_icon')); ?>"></i> <span class="pcount">0</span></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
            <ul class="navbar-nav">
                <?php echo render_menu_by_id($primary_menu); ?>

            </ul>
        </div>
        <div class="nav-right-content">
            <div class="icon-part nav-style-03">
                <ul>
                    <li class="cart"><a href="<?php echo e(route('frontend.products.cart')); ?>"><i class="<?php echo e(get_static_option('shopping_cart_icon')); ?>"></i> <span class="pcount"><?php echo e(cart_total_items()); ?></span></a></li>
                </ul>
            </div>
            <?php if(!empty(get_static_option('navbar_button'))): ?>
            <ul>
                <li class="info-bar-item style-01">
                    <div class="icon">
                        <i class="<?php echo e(get_static_option('navbar_title_icon')); ?>"></i>
                    </div>
                    <div class="content">
                        <span class="title"><?php echo e(get_static_option('navbar_button_title_'.$user_select_lang_slug)); ?>

                    </span>
                        <p class="details"><?php echo e(get_static_option('navbar_button_details_'.$user_select_lang_slug)); ?></p>
                    </div>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</nav><?php /**PATH /home/drsunitamishra.com/public_html/resources/views/frontend/partials/navbar/navbar-variant-home-03.blade.php ENDPATH**/ ?>