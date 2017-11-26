<?php
    class Circle
    {
        private $radius;

        public function __construct($r)
        {
            $this->radius = $r;
        }

        public function __toString()
        {
            return "半径为 ".$this->radius." 的圆，面积为 ".round($this->getArea(), 2)."<br />";
        }

        public function getArea()
        {
            return pi() * pow($this->radius, 2);
        }
    }

    echo new Circle(10);
    echo new Circle(5)
?>