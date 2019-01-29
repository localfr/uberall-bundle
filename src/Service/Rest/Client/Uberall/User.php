<?php

namespace Localfr\UberallBundle\Service\Rest\Client\Uberall;

use Localfr\UberallBundle\Service\Rest\Client\UberallClient;
use Localfr\UberallBundle\src\Provider\User as UserProvider;
use Localfr\UberallBundle\src\Exception\UserException;
use Symfony\Component\HttpFoundation\Response;

class User extends UberallClient
{
    /**
     * @param string $email
     *
     * @return mixed the uberall user if exists, null otherwise
     * @throws UserException
     */
    public function getByEmail($email)
    {
        if (!isset($email)) {
            throw new UserException('Missing email on main contact.');
        }

        $content = $this->get('/api/users?query=' . $email);
        if ('SUCCESS' === $content->status && $content->response && 0 !== $content->response->count) {
            // We must verify all results because uberall user search is not strict like the 'LIKE %search%' in SQL
            foreach ($content->response->users as $user) {
                if ($email === $user->email) {
                    return $user;
                }
            }
        }

        return null;
    }

    /**
     * @param UserProvider $userData previously collected from salesforce
     *
     * @return mixed
     *
     * @throws UserException
     */
    public function create(UserProvider $userData)
    {

        if ($user = $this->getByEmail($userData->email)) {
            return $user;
        }

        $json = json_encode([
            'email' => $userData->email,
            "firstname" => $userData->firstname ?: '.',
            "lastname" => $userData->lastname,
            'whitelabelInformationIdentifier' => $userData->whitelabelInformationIdentifier ?: 'localfr',
            'managedLocations' => $userData->managedLocations,
            'password' => bin2hex(openssl_random_pseudo_bytes(10)),
            'preferredLanguage' => $userData->preferredLanguage ?: 'FR',
            'role' => $userData->role ?: 'LOCATION_MANAGER',
            'status' => $userData->status ?: 'VERIFIED',
        ]);

        $content = $this->post('/api/users', $json);

        if ('SUCCESS' === $content->status) {
            // @TODO : do it with another way ?
            echo 'User ' . $content->response->user->email . ' successfuly created' . PHP_EOL;

            return $content->response->user;
        }

        $message = $content->message ?? var_export($content, true);

        throw new UserException(sprintf('Error on user creation : %s', $message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $id userId to remove
     *
     * @return void
     * @throws UserException
     */
    public function remove($id)
    {
        $content = $this->delete('/api/users/' . $id);
        if ('SUCCESS' === $content->status) {
            // @TODO : do it with another way ?
            echo 'User ' . $id . ' successfuly deleted' . PHP_EOL;

            return;
        }

        $message = $content->message ?? var_export($content, true);

        throw new UserException(sprintf('Error on user deletion : %s', $message), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
