<footer class="site-footer">
    <div class="container-main">
        <div class="footer-content">
            <div class="footer-menu">
                 <nav class="footer-nav">
                    <a href="<?php echo esc_url(home_url('/about')); ?>"><?php echo __('About Us', 'tahseen-ashrafi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"><?php echo __('Privacy Policy', 'tahseen-ashrafi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/terms-and-conditions')); ?>"><?php echo __('Terms and Conditions', 'tahseen-ashrafi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/disclaimer')); ?>"><?php echo __('Disclaimer', 'tahseen-ashrafi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>"><?php echo __('Contact Us', 'tahseen-ashrafi'); ?></a>
                    <a href="<?php echo esc_url(home_url('/sitemap')); ?>"><?php echo __('Sitemap', 'tahseen-ashrafi'); ?></a>
                    <a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" target="_blank" rel="nofollow"><?php echo __('RSS', 'tahseen-ashrafi'); ?></a>
                </nav>
            </div>
            
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> <strong>TAHSEEN ASHRAFI</strong>. <?php echo __('All rights reserved.', 'tahseen-ashrafi'); ?></p>
            </div>
        </div>
    </div>
</footer>

<button class="back-to-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">↑</button>

<?php wp_footer(); ?>

</body>
</html>
