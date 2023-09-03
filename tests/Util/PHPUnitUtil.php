<?php
namespace Tests\Util;

use ReflectionClass;

class PHPUnitUtil {
    /**
     * Get a private or protected method for testing/documentation purposes.
     * How to use for MyClass->foo():
     *      $cls = new MyClass();
     *      $foo = PHPUnitUtil::getPrivateMethod($cls, 'foo');
     *      $foo->invoke($cls, $...);
     * @param object $obj The instantiated instance of your class
     * @param string $name The name of your private/protected method
     * @return ReflectionMethod The method you asked for
     */
    public static function getPrivateMethod($obj, $name, array $args) {
      $class = new ReflectionClass($obj);
      $method = $class->getMethod($name);
      $method->setAccessible(true); // Use this if you are running PHP older than 8.1.0
      return $method->invokeArgs($obj, $args);
    }
}
?>