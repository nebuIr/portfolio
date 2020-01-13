<?php


class Components
{
    public function renderProjects($filter): void
    {
        include_once __DIR__ . '/locale.php';
        $projects_file = file_get_contents(__DIR__ . '/../projects.json');
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
                        <h1>{$project['title']}</h1>
                        <div class='badge-wrapper'><h2><span class='badge $badge'>{$project['status']}</span></h2></div>
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
}