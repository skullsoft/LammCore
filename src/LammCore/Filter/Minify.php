<?php

namespace LammCore\Filter;


class Minify
{

    protected $isXhtml = null;
    protected $replacementHash = null;
    protected $placeholders = array();

    public function filter($value)
    {
        //Was the passed $value a file?
        if (is_file($value)) {
            $value = file_get_contents($value);
        }

        //Perform minification on $value
        $value = str_replace("\n",'',$value);

        //Return the minified string
        return $value;
    }

}

