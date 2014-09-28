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
     * Возвращает список поддержиываемых доменов
     *
     * @abstract
     * @access public
     * @return void
     */

    abstract public function getSupportedDomains();

    /**
     * Распарсить заданный адрес и вернуть объект с данными
     *
     * @param string $url
     * @access public
     * @return array
     */

    public function parseUrl($url)
    {
        if (!$this->isSupportedUrl($url))
        {
            $this->log('Адрес ' . var_export($url, true) . ' не поддерживается');
            return array();
        }

        return $this->parseContent(
            $this->get($url)
        );
    }

    /**
     * Проверка адреса на корректность
     *
     * @param string $url
     * @abstract
     * @access protected
     * @return bool
     */

    abstract protected function isSupportedUrl($url);

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
     * Распарсить страницу со списком
     *
     * @abstract
     * @access public
     * @return void
     */

    abstract public function parseList();

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
     * @param string $text
     * @param bool $new_line
     * @param string $color
     * @access protected
     * @return ParserAbstract this
     */

    protected function log($text, $new_line = true, $color = 'default')
    {
        echo $text . PHP_EOL;

        return $this;
    }

    /**
     * Вывести на экран сообщение об ошибке
     *
     * @param string $text
     * @access protected
     * @return ParserAbstract this
     */

    protected function logError($text)
    {
        return $this->log('ERROR: ' . $text);
    }

    /**
     * Вывести на экран сообщение об предупреждении
     *
     * @param string $text
     * @access protected
     * @return ParserAbstract this
     */

    protected function logWarning($text)
    {
        return $this->log('WARNING: ' . $text);
    }
}
