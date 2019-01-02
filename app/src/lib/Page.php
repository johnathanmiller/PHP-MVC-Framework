<?php

class Page
{

    /**
     * Title
     * 
     * @since 2.0.0
     * @access public
     * @static
     * 
     * @param array $data View parameters
     * @param string $sep Title separator, null by default
     * @return string
     */
    public static function title(array $data, string $sep = null) : string
    {
        $sep = (is_null($sep)) ? '-' : $sep;
        $title_array = [];
        
        if (isset($data['title']) && !is_null($data['title'])) {
            $title_array[] = $data['title'];

        } elseif (isset($data['controller']) && $data['controller'] !== 'home' && isset($data['view']) && $data['view'] === 'index') {
            $title_array[] = ucfirst($data['controller']);

        } elseif (isset($data['view']) && $data['view'] !== 'index') {
            $title_array[] = ucfirst($data['view']);
        }

		return (!empty($title_array)) ? implode(' ', $title_array) . ' ' . $sep . ' ' . SITE_NAME : SITE_NAME;
    }

}