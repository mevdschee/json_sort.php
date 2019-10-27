# json_sort.php

Have you ever tried to write unit tests for JSON output? Did you run into the "unordered" nature of JSON 
in accordance with [RFC 7159](https://tools.ietf.org/html/rfc7159)? If so, this repo is for you!

It provides a single method that parses the JSON and reproduces it sorted in Lexicographical order.
It has no dependencies (other than json support in PHP) and is a single method. No path matching or PHPUnit required.

[Show me the code!](json_sort.php)

NB: If you do use PHPUnit, then take a look at the "`assertEqualsCanonicalizing`" function [here](https://phpunit.readthedocs.io/en/latest/assertions.html#assertequalscanonicalizing).
