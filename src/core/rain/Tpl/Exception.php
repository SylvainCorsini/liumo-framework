<?php

namespace Core\Rain\Tpl;

/**
 * Basic Rain tpl exception.
 */
class Exception extends \Exception
{
    /**
     * Path of template file with error.
     */
    protected $templateFile = '';

    /**
     * Handles path of template file with error.
     *
     * @param string | null $templateFile
     * @return \Core\Rain\Tpl\Exception | string
     */
    public function templateFile($templateFile)
    {
        if (is_null($templateFile))
            return $this->templateFile;

        $this->templateFile = (string)$templateFile;
        return $this;
    }
}