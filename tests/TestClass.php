<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

 class TestClass
 {
     public $param1=1;
     private $param2=3;
     private $param3=3;
     private $param4=3;
     private $param5=3;

     /**
      * @return int
      */
     public function getParam1(): int
     {
         return $this->param1;
     }

     /**
      * @param int $param3
      */
     public function setParam3(int $param3): void
     {
         $this->param3 = $param3;
     }
 }
