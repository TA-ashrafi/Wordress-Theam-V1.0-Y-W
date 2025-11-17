<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-wrapper">
        <!-- Mobile Menu Toggle (Left side) -->
        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
            ☰
        </button>
        
        <!-- Centered Logo -->
        <div class="site-logo-center">
            <?php if (get_theme_mod('tahseen_ashrafi_logo')) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(get_theme_mod('tahseen_ashrafi_logo')); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
            <?php else : ?>
                <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            <?php endif; ?>
        </div>
        
        <!-- Dark/Light Toggle -->
        <button class="theme-toggle-btn" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
            🌓
        </button>
        
        <!-- Navigation Menu -->
        <nav class="main-navigation" id="mainNavigation">
            <div class="nav-menu-wrapper">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'tahseen_ashrafi_fallback_menu',
                ));
                ?>
            </div>
        </nav>
    </div>
</header>

<?php
// Fallback menu if no menu is set
function tahseen_ashrafi_fallback_menu() {
    echo '<ul class="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/india')) . '">India</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/world')) . '">World</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/sports')) . '">Sports</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/entertainment')) . '">Entertainment</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/automobile')) . '">Automobile</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/business')) . '">Business</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/lifestyle')) . '">Lifestyle</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/tech')) . '">Tech</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/education')) . '">Education</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/science')) . '">Science</a></li>';
    echo '</ul>';
}
?>

<script>
function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
}

function toggleMobileMenu() {
    const nav = document.getElementById('mainNavigation');
    const toggle = document.querySelector('.mobile-menu-toggle');
    nav.classList.toggle('active');
    toggle.classList.toggle('active');
}

// Load saved theme on page load
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    
    // Back to top button
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    
    // Close mobile menu on link click
    const navLinks = document.querySelectorAll('.primary-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            const nav = document.getElementById('mainNavigation');
            const toggle = document.querySelector('.mobile-menu-toggle');
            nav.classList.remove('active');
            toggle.classList.remove('active');
        });
    });
});
</script>
