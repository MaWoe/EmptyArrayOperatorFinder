<?php

namespace MaWoe\EmptyArrayOperatorFinder;

class Finder
{
    const STATE_NOWHERE = 0;
    const STATE_EXPECTING_CLOSING_BRACKET = 1;
    const STATE_EXPECTING_ASSIGNMENT = 2;

    private $matchState;

    public function getMatches(string $fileContents): array
    {
        $this->resetMatchState();

        $currentLine = null;
        $matches = [];
        foreach (token_get_all($fileContents) as $tokenInfo) {
            $token = Token::createFromTokenGetAllToken($tokenInfo);
            if ($token->hasLine()) {
                $currentLine = $token->line;
            }

            if ($token->isWhiteSpace()) {
                continue;
            }

            if ($this->openingBracketExpected()) {
                if ($token->matchesCode('[')) {
                    $this->expectClosingBracket();
                }
            } elseif ($this->closingBracketExpected()) {
                if ($token->matchesCode(']')) {
                    $this->expectAssignment();
                } else {
                    $this->resetMatchState();
                }
            } elseif ($this->assignmentExpected()) {
                if ($token->matchesCode('=')) {
                    $matches[] = $currentLine;
                    $this->resetMatchState();
                } else {
                    $this->resetMatchState();
                }
            }
        }

        return $matches;
    }

    private function openingBracketExpected(): bool
    {
        return $this->matchState === self::STATE_NOWHERE;
    }

    private function closingBracketExpected(): bool
    {
        return $this->matchState === self::STATE_EXPECTING_CLOSING_BRACKET;
    }

    private function assignmentExpected(): bool
    {
        return $this->matchState === self::STATE_EXPECTING_ASSIGNMENT;
    }

    private function expectAssignment(): void
    {
        $this->matchState = self::STATE_EXPECTING_ASSIGNMENT;
    }

    private function resetMatchState(): void
    {
        $this->matchState = self::STATE_NOWHERE;
    }

    private function expectClosingBracket(): void
    {
        $this->matchState = self::STATE_EXPECTING_CLOSING_BRACKET;
    }
}