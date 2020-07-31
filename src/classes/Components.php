<?php

namespace nebulr;

class Components
{
    public function renderProjects($filter): void
    {
        $neb_locales = new Locales;
        $locale = $neb_locales->getLocale();
        $projects_file = file_get_contents(__DIR__ . '/../../public/assets/projects.json');
        $projects = json_decode($projects_file, true, 512, JSON_THROW_ON_ERROR);
        $badge = '';

        foreach ($projects as $project) {
            if ($filter === $project['status_code'] || $filter === 'all') {
                switch (true) {
                    case $project['status_code'] === 0:
                        $badge = 'badge-green';
                        break;
                    case $project['status_code'] === 1:
                        $badge = 'badge-yellow';
                        break;
                    case $project['status_code'] === 2:
                        $badge = 'badge-red';
                        break;
                }

                echo "
                <div class='card radius-large'>
                    <img class='card-img' src='{$project['cover']}' alt='cover'>
                    <div class='card-txt'>
                        <h2>{$project['title']}</h2>
                        <div class='badge-wrapper'><div class='card-status'><span class='badge $badge'>{$project['status']}</span></div></div>
                        <p>{$project['description']}</p>
                    </div>
                <div class='card-links'>";
                if ($project['urls']['url_1'] !== '') {
                    echo "
                    <a href='{$project['urls']['url_1']}' target='_blank'>
                        <div class='button button-left'>{$project['btn_text']['btn_text_1']} <i class='fas fa-info-circle'></i></div>
                    </a>";
                } else {
                    echo "<div class='button-disabled button-left'>{$project['btn_text']['btn_text_1']} <i class='fas fa-info-circle'></i></div>";
                }
                if ($project['urls']['url_2'] !== '') {
                    echo "
                    <a href='{$project['urls']['url_2']}' target='_blank'>
                        <div class='button button-right'>{$project['btn_text']['btn_text_2']} <i class='fas fa-cloud-download-alt'></i></div>
                    </a>";
                } else {
                    echo "<div class='button-disabled button-right'>{$project['btn_text']['btn_text_2']} <i class='fas fa-cloud-download-alt'></i></div>";
                }
                echo "
                </div>
                    <div class='card-footer'>
                        <p>{$locale['LAST_UPDATED']}: {$project['last_updated']}</p>
                    </div>
                </div>";
            }
        }
    }

    public function errorCode(): array
    {
        $title = 'Unknown Error';
        $description = 'An unknown error occurred';

        switch($_SERVER['REDIRECT_STATUS']){
            case 400:
                $title = '400 Bad Request';
                $description = 'Your client has issued a malformed or illegal request.';
                break;

            case 401:
                $title = '401 Unauthorized';
                $description = 'You are not authorized to access this page.';
                break;

            case 403:
                $title = '403 Forbidden';
                $description = 'You do not have access to this page.';
                break;

            case 404:
                $title = '404 Not Found';
                $description = 'The requested URL was not found on this server.';
                break;

            case 500:
                $title = '500 Internal Server Error';
                $description = 'There was an error. Please try again later.';
                break;

            case 502:
                $title = '502 Bad Gateway';
                $description = 'The server encountered a temporary error and could not complete the request.';
                break;

            case 504:
                $title = '504 Gateway Timeout';
                $description = 'The server encountered a temporary error and could not complete the request.';
                break;
        }

        return [$title, $description];
    }
}