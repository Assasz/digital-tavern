<?php

namespace DigitalTavern\Application\Service\SessionModule\Response;

use Yggdrasil\Core\Service\ServiceResponseInterface;

/**
 * Class RenderMessageResponse
 *
 * @package DigitalTavern\Application\Service\SessionModule\Response
 */
class RenderMessageResponse implements ServiceResponseInterface
{
    /**
     * Session message template
     *
     * @var null|string
     */
    private $messageTemplate;

    /**
     * Returns message template
     *
     * @return null|string
     */
    public function getMessageTemplate(): ?string
    {
        return $this->messageTemplate;
    }

    /**
     * Sets message template
     *
     * @param string $messageTemplate
     */
    public function setMessageTemplate(string $messageTemplate): void
    {
        $this->messageTemplate = $messageTemplate;
    }
}