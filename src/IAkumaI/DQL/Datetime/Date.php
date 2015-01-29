<?php

namespace IAkumaI\DQL\Datetime;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;


/**
* DATE(field)
*
* http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_date
*/
class Date extends FunctionNode
{
    public $str;
    public $substr;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->str = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'DATE('.
            $this->str->dispatch($sqlWalker).
        ')';
    }
}
