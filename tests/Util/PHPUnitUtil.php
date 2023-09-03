<?php
namespace Tests\Util;

use ReflectionClass;

class PHPUnitUtil {
    /**
     * A private or protected method can be accessed using this method.
     *  $foo = PHPUnitUtil::getPrivateMethod($cls, 'foo');
     *  $foo->invoke($cls, $...);
     * @param object $obj The instantiated instance of your class
     * @param string $name The name of your private/protected method
     * @return ReflectionMethod The method you asked for
     */
    public static function getPrivateMethod($obj, $name, array $args) {
      $class = new ReflectionClass($obj);
      $method = $class->getMethod($name);
      $method->setAccessible(true); 
      return $method->invokeArgs($obj, $args);
    }
}
?>