<?php

class Message {

    const MESSAGE_COLOR_SUCCESS = "green lighten-2";
    const MESSAGE_COLOR_ERROR = "red lighten-2";

    private string $message;
    private string $color;
    private string $title;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function __construct(string $message, string $color="light-blue lighten-1", string $title="Message"){
        $this->message = $message;
        $this->color = $color;
        $this->title = $title;
    }
}