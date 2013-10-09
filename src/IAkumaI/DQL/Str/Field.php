<?php

namespace IAkumaI\DQL\Str;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;


/**
* FIELD(exp1, exp2, exp3, exp4...)
*
* More: http://dev.mysql.com/doc/refman/5.0/en/string-functions.html#function_field
*/
class Field extends FunctionNode
{
    private $field;
    private $values = array();

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->field = $parser->ArithmeticPrimary();
        $lexer = $parser->getLexer();

        while (count($this->values) < 1 || $lexer->lookahead['type'] != Lexer::T_CLOSE_PARENTHESIS) {
            $parser->match(Lexer::T_COMMA);
            $this->values[] = $parser->ArithmeticPrimary();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        $query = 'FIELD('.$this->field->dispatch($sqlWalker).',';

        for ($i = 0; $i < count($this->values); $i++) {
            if ($i > 0) {
                $query .= ',';
            }

            $query .= $this->values[$i]->dispatch($sqlWalker);
        }

        $query .= ')';

        return $query;
    }
}
