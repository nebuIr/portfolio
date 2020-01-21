<nav>
    <ul>
        <li><img class='nav-logo' src='/assets/img/logo/logo.png' alt='logo'/></li>
        <li><a <?php if ($url === 'https://nebulr.me' || $url === 'https://nebulr.localhost' || $url === 'https://nebulr.me/' || $url === 'https://nebulr.localhost/') echo "class='active'" ?>href='/'>Home</a></li>
        <li><a <?php if (strpos($url,'/projects') !== false) echo "class='active'" ?>href='/projects'>Projects</a></li>
    </ul>
</nav>