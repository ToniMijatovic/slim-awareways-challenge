<?php

namespace App\Services;

use App\Models\Term;

class TermService extends Service
{
    private string $text;

    /**
     * @param $text
     * @return $this
     */
    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return array
     */
    public function create(): array
    {
        $term = Term::updateOrCreate(['id' => $this->id ?? null], [
            'text' => $this->text
        ]);

        if ($term) {
            return $term->toArray();
        }

        return [];
    }
}
