<?php

/*
FizzBuzz generator
1. Generate/print a list of integers, from 1 to 100
2. Numbers that are divisible by 3 should be replaced with “Fizz”
3. Numbers that are divisible by 5 should be replaced with “Buzz”
4. Numbers that are both divisible by 3 and by 5 should be replaced with “FizzBuzz”
*/
interface GeneratorInterface
{
    public function generate(): array;
}

class ListGenerator implements generatorInterface
{
    private $max;
    private $div1;
    private $div2;

    public function __construct(int $max, int $div1, int $div2)
    {
        $this->max = $max;
        $this->div1 = $div1;
        $this->div2 = $div2;
    }

    public function generate(): array
    {
        $list = range(1, $this->max);
        for ($i = 0; $i < count($list); $i++) {
            if ($this->isDivisible($list[$i], [$this->div1, $this->div2])) {
                $list[$i] = 'FizzBuzz';
            } else if ($this->isDivisible($list[$i], [$this->div1])) {
                $list[$i] = 'Fizz';
            } else if ($this->isDivisible($list[$i], [$this->div2])) {
                $list[$i] = 'Buzz';
            }
        }
        return $list;
    }

    private function isDivisible($item, array $div): bool
    {
        foreach ($div as $d) {
            if ($item % $d !== 0) {
                return false;
            }
        }
        return true;
    }
}

$listGenerator = new ListGenerator(100, 3, 5);
$list = $listGenerator->generate();
print_r($list);
