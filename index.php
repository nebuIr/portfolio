<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/assets/html/head.php"); ?>
    </head>

    <body>
        <?php include($_SERVER['DOCUMENT_ROOT'] . "/assets/html/nav.php"); ?>

        <main class="main-text-medium">
            <p align="center" class="title color-white weight-bold">nebulr</p>

            <div class="grid">
                <?php
				$projects_file = file_get_contents(__DIR__ . '/assets/projects.json');
				$projects = json_decode($projects_file, true);

				foreach ($projects as $project) {
					echo "<div class='new-card radius-large'>
                              <div class='card-overlay radius-large'>
                                  <div class='card-links'>
                                      <a href='{$project['url_info']}' target='_blank'>
                                        <div class='button button-left'>More Info<i class='fas fa-info-circle'></i></div>
                                      </a>
                                      <a href='{$project['url_dl']}' target='_blank'>
                                        <div class='button button-right'>Download<i class='fas fa-cloud-download-alt'></i></div>
                                      </a>
                                  </div>
                                  <div class='card-footer'>
                                    <p>Last updated: {$project['last_updated']}</p>
                                  </div>
                              </div>
                              <img class='card-img radius-large' src='{$project['cover']}' alt='cover'>
                          </div>";
                } ?>
            </div>
        </main>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/assets/html/footer.php"); ?>

    </body>

</html>
