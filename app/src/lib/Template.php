<?php

class Template
{

    protected $twig;

    public function __construct()
    {
        $twig_loader = new \Twig_Loader_Filesystem(DIR['VIEWS']);
        $this->twig = new \Twig_Environment($twig_loader);

        $this->addGlobals([
            'SITE_URL' => SITE_URL,
            'SITE_NAME' => SITE_NAME,
            'ASSETS_DIR' => DIR['ASSETS'],
            'CSS_DIR' => DIR['CSS'],
            'JS_DIR' => DIR['JS'],
            'YEAR' => date('Y')
        ]);

        $this->addFunctions([
            'Security',
            'Session',
            'Url'
        ]);
    }

    public function render(string $path, array $data = []) : string
    {
        return $this->twig->render($path, $data);
    }

    protected function addGlobals(array $values) : void
    {
        foreach ($values as $k => $v) {
            $this->twig->addGlobal($k, $v);
        }
    }

    protected function addFunctions(array $values) : void
    {
        foreach ($values as $class) {
            $this->twig->addFunction(new \Twig_Function(strtolower($class), function($function, $args = []) use ($class) {
                if (method_exists($class, $function)) {
                    return call_user_func_array([$class, $function], $args);
                }
            }));
        }
    }

}