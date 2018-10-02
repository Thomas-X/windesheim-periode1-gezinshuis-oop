<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02/10/18
 * Time: 11:29
 */

namespace Qui\lib;

/*
 * Since PHP's mail function is a pain to setup (cross platform compatibility is worthless). It seemed to me like a good idea to
 * use some of my python skills and make this a simple wrapper around a python file.
 * Does not support attachments at this moment. Could be added if needed.
 * */

use phpDocumentor\Parser\Exception;
use Qui\lib\facades\Util;

class CMailer
{
    public const MAIL_DEFAULT = [
        'to' => null,
        'subject' => null,
        'body' => null,
    ];
    private $mail = CMailer::MAIL_DEFAULT;

    public function setupMail()
    {
        $this->mail = CMailer::MAIL_DEFAULT;
        return $this;
    }

    public function to($to)
    {
        $this->mail['to'] = $to;
        return $this;
    }

    public function subject($subject)
    {
        $this->mail['subject'] = $subject;
        return $this;
    }

    public function body($body)
    {
        $this->mail['body'] = $body;
        return $this;
    }

    public function send()
    {
        if (!$this->mail['to'] || !$this->mail['body'] || !$this->mail['subject']) {
            throw new Exception('Invalid email to be sent, missing data');
        }
        $pyFile = __DIR__ . '/python/main.py';
        try {
            shell_exec("{$_ENV['PYTHON3_NAME']} {$pyFile} \"{$this->mail['to']}\" \"{$this->mail['subject']}\" \"{$this->mail['body']}\" \"{$_ENV['GMAIL_EMAIL']}\" \"{$_ENV['GMAIL_PASSWORD']}\"");
        } catch (\Exception $exception) {
            var_dump($exception);
            die;
        }
        return true;
    }
}