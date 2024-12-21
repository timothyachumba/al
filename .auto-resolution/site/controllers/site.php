<?php

return function ($site, $page) {
    // Fetch all children of the site that use the 'project' template
    $template = $page->template()->name();
    $projects = $site->children()->template('project');

    // Return the variable
    return [
        'projects' => $projects,
        'template' => $template
    ];
};