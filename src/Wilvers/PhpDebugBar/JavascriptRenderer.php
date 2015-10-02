<?php

/*
 * This file is part of the DebugBar package.
 *
 * (c) 2013 Maxime Bouroumeau-Fuseau
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wilvers\PhpDebugBar;

use DebugBar\DataCollector\Renderable;
use DebugBar\DataCollector\AssetProvider;

/**
 * Renders the debug bar using the client side javascript implementation
 *
 * Generates all the needed initialization code of controls
 */
class JavascriptRenderer extends \DebugBar\JavascriptRenderer {

    /**
     * Renders the html to include needed assets
     *
     * Only useful if Assetic is not used
     *
     * @return string
     */
    public function renderHead() {
        list($cssFiles, $jsFiles) = $this->getAssets(null, self::RELATIVE_URL);
        return array("css" => $cssFiles, "js" => $jsFiles);

        $html = '';

        foreach ($cssFiles as $file) {
            $html .= sprintf('<link rel="stylesheet" type="text/css" href="%s">' . "\n", $file);
        }

        foreach ($jsFiles as $file) {
            $html .= sprintf('<script type="text/javascript" src="%s"></script>' . "\n", $file);
        }

        if ($this->enableJqueryNoConflict) {
            $html .= '<script type="text/javascript">jQuery.noConflict(true);</script>' . "\n";
        }

        return $html;
    }

    /**
     * Returns the code needed to display the debug bar
     *
     * AJAX request should not render the initialization code.
     *
     * @param boolean $initialize Whether to render the de bug bar initialization code
     * @return string
     */
    public function render($initialize = true, $renderStackedData = true) {
        $js = '';

        if ($initialize) {
            $js = $this->getJsInitializationCode();
        }

        if ($renderStackedData && $this->debugBar->hasStackedData()) {
            foreach ($this->debugBar->getStackedData() as $id => $data) {
                $js .= $this->getAddDatasetCode($id, $data, '(stacked)');
            }
        }

        $suffix = !$initialize ? '(ajax)' : null;
        $js .= $this->getAddDatasetCode($this->debugBar->getCurrentRequestId(), $this->debugBar->getData(), $suffix);

        return "\n$js\n";

        //return "<script type=\"text/javascript\">\n$js\n</script>\n";
    }

    /**
     * retourne l'array avec les js inclus des vendors
     * @return mixed
     */
    public function getJsVendors() {
        return $this->jsVendors();
    }

    /**
     * remplace l'array js des vendors par celui passé en paramètre
     * @param array $array
     * @return $this
     */
    public function setJsVendors($array = array()) {
        $this->jsVendors = $array;
        return $this;
    }

    /**
     * retire des vendors le js passé en paramètre
     * @param $js
     * @return $this
     */
    public function removeJsVendors($js) {
        for ($i = 0; $i < count($this->jsVendors); $i++) {
            if ($js == $this->jsVendors[$i])
                unset($this->jsVendors[$i]);
        }
        return $this;
    }

    /**
     * ajoutte aux vendors le js passé en paramètre
     * @param $js
     * @return $this
     */
    public function addJsVendors($js) {
        if (!in_array($js, $this->jsVendors)) {
            $this->jsVendors[] = $js;
        }
        return $this;
    }

}
