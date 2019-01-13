<?php

namespace App\Domains\Models\JWT;

class JsonWebToken
{
    /**
     * @var int JWT有効期限 一週間
     */
    const TIME_TO_LIVE = 64800;

    /**
     * @var string JWT
     */
    private $jwt;

    /**
     * @param string JWT
     */
    public function __construct(string $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @return string JWT
     */
    public function token(): string
    {
        return $this->jwt;
    }

    /**
     * @return string トークンタイプ
     */
    public function type(): string
    {
        return 'bearer';
    }

    /**
     * @return string JWT有効期限
     */
    public function ttl(): int
    {
        return self::TIME_TO_LIVE;
    }
}