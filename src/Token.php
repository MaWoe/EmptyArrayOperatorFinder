<?php

namespace MaWoe\EmptyArrayOperatorFinder;

class Token
{
    public $line;

    public $code;

    public $token;

    /**
     * @param string|array $tokenDescription
     *
     * @return Token
     */
    public static function createFromTokenGetAllToken($tokenDescription)
    {
        $token = new Token();

        if (is_array($tokenDescription)) {
            list ($token->token, $token->code, $token->line) = $tokenDescription;
        } else {
            $token->code = $tokenDescription;
        }

        return $token;
    }

    /**
     * @return bool
     */
    public function hasLine()
    {
        return $this->line !== null;
    }

    /**
     * @param $tokenType
     *
     * @return bool
     */
    public function isOfType($tokenType)
    {
        return $this->token == $tokenType;
    }

    /**
     * @param string $code
     *
     * @return bool
     */
    public function matchesCode($code)
    {
        return $this->code == $code;
    }

    /**
     * @return bool
     */
    public function isWhiteSpace()
    {
        return $this->isOfType(T_WHITESPACE);
    }
}