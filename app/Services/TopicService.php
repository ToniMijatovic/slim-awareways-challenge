<?php

namespace App\Services;

use App\Models\Topic;

class TopicService extends Service
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
        $topic = Topic::updateOrCreate(['id' => $this->id ?? null], [
            'text' => $this->text
        ]);

        if ($topic) {
            return $topic->toArray();
        }

        return [];
    }
}
