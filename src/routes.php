<?php

function getPageContent($page): void
{
    switch ($page) {
        default:
        case '':
            include __DIR__ . '/templates/pages/home.php';
            break;

        case 'privacypolicy':
            include __DIR__ . '/templates/pages/privacypolicy.php';
            break;
    }
}