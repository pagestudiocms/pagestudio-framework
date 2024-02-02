<?php 

namespace Ps\Framework\Helpers;

/**
 * PathinfoOption Enum
 * 
 * @see https://onlinephp.io/c/f0049
 * @see https://stackoverflow.com/questions/254514/enumerations-on-php
 */
class PathinfoOption extends AbstractEnum
{
    /** @var string Absolute path to the file */
    const Dirname = PATHINFO_DIRNAME;

    /** @var string Filename without the extention  */
    const Basename = PATHINFO_BASENAME;
    
    /** @var string The file extension */
    const Extension = PATHINFO_EXTENSION;
    
    /** @var string The filename with the extention */
    const Filename = PATHINFO_FILENAME;

    /** @var int Filename plus absolute path */
    const File = 0;
}
