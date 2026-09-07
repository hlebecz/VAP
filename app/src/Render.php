<?php
declare(strict_types=1);

namespace App;

class Render {
    private string $viewsPath;
    private string $layoutPath;

    public function __construct(string $viewsPath, string $layoutPath) {
        $this->viewsPath = $viewsPath;
        $this->layoutPath = $layoutPath;
    }

    public function render(string $view, array $params = []): void {
        ob_start();
        extract($params);
        include $this->viewsPath . $view;
        $content = ob_get_clean();

        require $this->layoutPath;
    }
}

