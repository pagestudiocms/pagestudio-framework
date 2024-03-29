<?php

namespace Ps\Framework\Helpers;

use JsonSerializable;
use ReflectionClass;
use UnexpectedValueException;

abstract class AbstractEnum implements JsonSerializable
{
    /** @const Name of the default value constant */
    const __BETTER_ENUM_DEFAULT_KEY = '__default';

    /** @var array|null */
    private static $constCacheArray = null;

    /** @var mixed|null */
    private $value = null;

    /**
     * BetterEnum constructor
     * @param mixed|null $initial_value
     * @param bool $strict Provided for SplEnum compatibility (its purpose is unknown)
     */
    public function __construct($initial_value = null, $strict = false)
    {
        $enumClassName = get_called_class();

        if ($initial_value === null) {
            if (!self::isValidName(self::__BETTER_ENUM_DEFAULT_KEY)) {
                throw new UnexpectedValueException('Default value not defined in enum ' . $enumClassName);
            } else {
                $validValue = self::getConstants()[self::__BETTER_ENUM_DEFAULT_KEY];
            }
        } elseif (!self::isValidValue($initial_value)) {
            throw new UnexpectedValueException('Value not a const in enum ' . $enumClassName);
        } else {
            $validValue = $initial_value;
        }

        $this->value = $validValue;
    }

    /**
     * @param string $name Name of the constant to validate
     * @param bool $strict Case is significant when searching for name
     * @return bool
     */
    public static function isValidName($name, $strict = true)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $constantNames = array_map('strtoupper', array_keys($constants));
        return in_array(strtoupper($name), $constantNames);
    }

    /**
     * @param bool $includeDefault Include `__default` and its value. Included by default.
     * @return array
     */
    public static function getConstants($includeDefault = true)
    {
        if (self::$constCacheArray === null) {
            self::$constCacheArray = [];
        }
        $enumClassName = get_called_class();
        if (!array_key_exists($enumClassName, self::$constCacheArray)) {
            $reflect = new ReflectionClass($enumClassName);
            self::$constCacheArray[$enumClassName] = $reflect->getConstants();
            unset(self::$constCacheArray[$enumClassName]['__BETTER_ENUM_DEFAULT_KEY']);
        }

        $constants = self::$constCacheArray[$enumClassName];

        if ($includeDefault === false) {
            $constants = array_filter(
                $constants,
                function ($key) {
                    return $key !== self::__BETTER_ENUM_DEFAULT_KEY;
                },
                ARRAY_FILTER_USE_KEY
            );
        }

        return $constants;
    }

    /**
     * @param mixed $value Value to validate
     * @return bool
     */
    public static function isValidValue($value)
    {
        $constantValues = array_values(self::getConstants());
        return in_array($value, $constantValues, $strict = true);
    }

    /**
     * @deprecated 0.0.1 Provided for compatibility with SplEnum
     * @see BetterEnum::getConstants()
     * @param bool $include_default Include `__default` and its value. Not included by default.
     * @return array
     */
    public static function getConstList($include_default = false)
    {
        return self::getConstants($include_default);
    }

    /**
     * @return string String representation of the enum's value
     */
    public function __toString()
    {
        return strval($this->value);
    }

    /**
     * @return mixed
     */
    function jsonSerialize()
    {
        return $this->getValue();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
