<?php

namespace IAkumaI\DQL\Math;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;


/**
 * RANDP()
 *
 * You MUST use parameters with this function
 *
 * More: http://dev.mysql.com/doc/refman/5.0/en/mathematical-functions.html#function_rand
 */
class Randp extends FunctionNode
{
    protected $value;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->value = $parser->SimpleArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'RAND(' . $sqlWalker->walkSimpleArithmeticExpression($this->value) . ')';
    }
}
