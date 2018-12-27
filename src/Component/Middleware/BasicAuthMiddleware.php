<?php

namespace Component\Middleware;


use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;

class BasicAuthMiddleware
{
    /**
     * @var ServerRequestInterface
     */
    protected $request;
    /**
     * @var array
     */
    protected $users;


    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $userName = $request->getServerParams()['PHP_AUTH_USER'] ?? null;
        $pass = $request->getServerParams()['PHP_AUTH_PW'] ?? null;

        foreach ($this->users as $user => $password) {
            if ($user == $userName && $password == $pass) {
                return $next($request->withAttribute('user', $userName));
            }
        }
        return new EmptyResponse(401, ['WWW-Authenticate' => 'Basic realm=Login required']);
    }
}
