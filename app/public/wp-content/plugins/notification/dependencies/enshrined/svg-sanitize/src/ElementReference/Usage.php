<?php
/**
 * @license GPL-2.0-or-later
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */
namespace BracketSpace\Notification\Dependencies\enshrined\svgSanitize\ElementReference;

class Usage
{
    /**
     * @var Subject
     */
    protected $subject;

    /**
     * @var int
     */
    protected $count;

    /**
     * @param Subject $subject
     * @param int $count
     */
    public function __construct(Subject $subject, $count = 1)
    {
        $this->subject = $subject;
        $this->count = (int)$count;
    }

    /**
     * @param int $by
     */
    public function increment($by = 1)
    {
        $this->count += (int)$by;
    }

    /**
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}