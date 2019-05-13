<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Analyzer;

include __DIR__ . '/../../tests/TestClass.php';


/**
 * Class ClassInformation
 * Analyzer, for counting the number of properties, methods and types of classes
 *
 * @author Kubrak Anton <ljustpewpewl@gmail.com>
 */
class ClassInformation
{
    /**
     * @var string Class name for analyze
     */
    private $className;

    public function __construct(string $className)
    {
        $this->className=$className;
    }

    /**
     * Method for analyze class name, type, count properties and methods
     *
     * @throws \Exception
     *
     * @return array
     */
    public function analyze(): ?array
    {
        $array=[
            'className'=>'',
            'classType'=>'',
            'publicProperties'=>0,
            'protectedProperties'=>0,
            'privateProperties'=>0,
            'publicMethods'=>0,
            'protectedMethods'=>0,
            'privateMethods'=>0,
        ];

        try {
            $classAnalyzer= new \ReflectionClass($this->className);

            $array['className']=$classAnalyzer->getName();


            if ($classAnalyzer->isAbstract()) {
                $array['classType']='Abstract';
            } elseif ($classAnalyzer->isAnonymous()) {
                $array['classType']='Anonymous';
            } elseif ($classAnalyzer->isFinal()) {
                $array['classType']='Final';
            } elseif ($classAnalyzer->isIterable()) {
                $array['classType']='Iterable';
            } elseif (empty($array['classType'])) {
                $array['classType']='Default';
            }

            if ($classAnalyzer->getProperties()) {
                foreach ($classAnalyzer->getProperties()as $property) {
                    if ($property->isPrivate()) {
                        $array['privateProperties']++;
                    } elseif ($property->isProtected()) {
                        $array['protectedProperties']++;
                    } elseif ($property->isPublic()) {
                        $array['publicProperties']++;
                    }
                }
            }

            if ($classAnalyzer->getMethods()) {
                foreach ($classAnalyzer->getMethods() as $method) {
                    if ($method->isPublic()) {
                        $array['publicMethods']++;
                    } elseif ($method->isPrivate()) {
                        $array['privateMethods']++;
                    } elseif ($method->isProtected()) {
                        $array['protectedMethods']++;
                    }
                }
            }
        } catch (\ReflectionException $exception) {
            throw new \Exception("$this->className not found");
        }

        return $array;
    }
}
