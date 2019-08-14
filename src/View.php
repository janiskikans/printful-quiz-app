<?php


namespace Quiz;


class View
{

    /** @var string */
    protected $viewFile;

    /** @var string */
    protected $templateFile;

    /** @var string */
    protected $js = '';

    /** @var string[]  */
    protected $jsFiles = [];

    /** @var string[]  */
    protected $cssFiles = [];

    public function __construct(string $viewName, string $templateName)
    {
        $this->viewFile = $this->getViewFilePath($viewName);
        $this->templateFile = $this->getViewFilePath($templateName, TEMPLATE_BASE_FOLDER);
    }

    protected function getViewFilePath(string $viewName, string $baseDir = VIEW_BASE_FOLDER)
    {
        return $baseDir . DS . $viewName . '.php';
    }

    public function render(array $params = []): string
    {
        return $this->getFileContents($this->templateFile, $params);
    }

    public function renderView(string $viewName, array $params = [])
    {
        $filePath = $this->getViewFilePath($viewName);

        return $this->getFileContents($filePath, $params);
    }

    protected function getFileContents(string $fileName, array $params = [])
    {
        extract($params);
        $content = '';

        if (!empty($this->viewFile) && file_exists($this->viewFile)) {
            ob_start(); // Viss output nonāk atmiņā.
            include "$fileName";
            $content = ob_get_clean(); // Viss nonāk mainīgajā.
        }

        return $content;
    }

    /**
     * @param array $params
     * @return string
     */
    public function renderContent(array $params = []): string
    {
        return $this->getFileContents($this->viewFile, $params);
    }

    /**
     * @param string $js
     */
    public function registerJs(string $js)
    {
        $this->js .= $js;
    }

    /**
     * @param string $fileName
     */
    public function registerJsFile(string $fileName)
    {
        $this->jsFiles[] = $fileName;
    }

    public function registerCssFile(string $fileName)
    {
        $this->cssFiles[] = $fileName;
    }
}