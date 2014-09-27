<?php

/**
 * Класс абстрактного парсера рецептов
 *
 * @abstract
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

abstract class ParserAbstract
{
    /**
     * Распарсить заданный адрес и вернуть объект с данными
     *
     * @param string $url
     * @access public
     * @return array
     */

    public function parseUrl($url)
    {
        $this->parseContent(
            $this->get($url)
        );
    }

    /**
     * Распарсить контент страницы
     *
     * @param string $content
     * @abstract
     * @access protected
     * @return array
     */

    abstract protected function parseContent($content);

    /**
     * Добавить ссылку в очередь на обработку
     *
     * @param string $url
     * @access protected
     * @return void
     */

    protected function pushUrl($url)
    {
        $this->log('Push :' . $url);
    }

    /**
     * Получает контент страницы
     *
     * @param string $url
     * @access protected
     * @return string
     */

    protected function get($url)
    {
        return file_get_contents($url);
    }

    /**
     * Выводит информацию на экран
     *
     * @param text $text
     * @access protected
     * @return void
     */

    protected function log($text)
    {
        echo $text . PHP_EOL;

        return $this;
    }
}
