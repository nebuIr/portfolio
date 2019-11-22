<?php


class components
{
    function renderProjects() {
        $projects_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/projects.json');
        $projects = json_decode($projects_file, true);

        foreach ($projects as $project) {
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

            echo "<div class='card radius-large' style='background-image: url({$project['cover']});'>
            <div class='card-txt'>
                <h1>{$project['title']}</h1>
                <div class='badge-wrapper'><h2><span class='badge $badge'>{$project['status']}</span></h2></div>
                <p>{$project['description']}</p>
            </div>
            <div class='card-links'>";
            if ($project['url_info'] !== '') {
                echo "<a href='{$project['url_info']}' target='_blank'>
                <div class='button button-left'>More Info <i class='fas fa-info-circle'></i></div>
                </a>";
            } else {
                echo "<div class='button-disabled button-left'>More Info <i class='fas fa-info-circle'></i></div>";
            }
            if ($project['url_dl'] !== '') {
                echo "<a href='{$project['url_dl']}' target='_blank'>
                <div class='button button-right'>Download <i class='fas fa-cloud-download-alt'></i></div>
                </a>";
            } else {
                echo "<div class='button-disabled button-right'>Download <i class='fas fa-cloud-download-alt'></i></div>";
            }
            echo "</div>
            <div class='card-footer'>
                <p>Last updated: {$project['last_updated']}</p>
            </div>
            </div>";
        }
    }
}