<?php

class Template
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @var array
     */
    private array $parameters = [];

    /**
     * Template constructor.
     * @param string $path
     * @param array $parameters
     */
    public function __construct(string $path, array $parameters = [])
    {
        $this->path = rtrim($path, '/').'/';
        $this->parameters = $parameters;
    }

    /**
     * @param string $view
     * @param array $context
     * @return string
     * @throws Exception
     */
    public function render(string $view, array $context = []): string
    {
        if (!file_exists($file = $this->path.$view)) {
            throw new Exception(sprintf('The file %s could not be found.', $view));
        }

        extract(array_merge($context, ['template' => $this]));

        ob_start();

        include ($file);

        return ob_get_clean();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }
}
