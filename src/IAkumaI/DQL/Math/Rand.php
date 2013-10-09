<?php

namespace IAkumaI\DQL\Math;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;


/**
 * RAND()
 *
 * You CAN NOT use parameters with this function
 *
 * More: http://dev.mysql.com/doc/refman/5.0/en/mathematical-functions.html#function_rand
 */
class Rand extends FunctionNode
{

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'RAND()';
    }
}
