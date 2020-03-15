<?php

class ShortUrl
{
    private $baseString;
    private $baseLength;

    public function __construct()
    {
        // case Compliant base58
        $this->baseString = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        
        // If you change the order of the strings, the issued strings will also change
        // $this->baseString = 'hwqAQ4JfZTLvU79xX5YEdrHRMe3NjPyuioGKmpFbDkcSntBzgVW621a8Cs';

        // If you limit it as a compressed URL, there is no problem
        // even if you add 63 characters including 'O', 'l', 'I', '-', '_'
        // $this->baseString = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPOQRSTUVWXYZ-_';

        $this->baseLength = strlen($this->baseString);
    }

    /**
     * @return String
     */
    public function encode(int $num): string
    {
        if (!is_numeric($num)) {
            throw new Exception('TypeError : $num of value must be integer.');
        }

        $encode = '';

        while ($num) {
            $remainder = $num % $this->baseLength;
            $num       = floor($num / $this->baseLength);
            $encode   .= $this->baseString[$remainder];
        }

        return strrev($encode);
    }
}