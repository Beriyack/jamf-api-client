<?php

namespace Beriyack\Jamf;

use Beriyack\Client\ApiClient;
use Exception;

/**
 * Un client PHP pour interagir avec l'API Jamf (apiv6.zuludesk.com).
 *
 * Cette classe sert de wrapper autour de la bibliothèque générique beriyack/api-client,
 * en la configurant spécifiquement pour les besoins de l'API Jamf.
 *
 * @package Beriyack\Jamf
 * @author Beriyack
 * @version 1.0.0
 */
class JamfApiClient
{
    const BASE_URL = 'https://apiv6.zuludesk.com';

    private ApiClient $client;

    /**
     * Constructeur de la classe JamfApiClient.
     *
     * @param string $networkId Votre Network ID pour l'authentification.
     * @param string $key Votre clé d'API pour l'authentification.
     * @param string|null $caCertPath Le chemin vers le fichier de certificat CA (par exemple, 'Amazon Root CA 1.crt').
     */
    public function __construct(string $networkId, string $key, ?string $caCertPath = null)
    {
        $defaultCurlOptions = [
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD  => "$networkId:$key",
        ];

        if ($caCertPath !== null) {
            if (!file_exists($caCertPath)) {
                throw new Exception("Le fichier de certificat CA '{$caCertPath}' est introuvable.");
            }
            $defaultCurlOptions[CURLOPT_CAINFO] = $caCertPath;
        }

        $this->client = new ApiClient(self::BASE_URL, [], $defaultCurlOptions);
    }

    /**
     * Récupère toutes les applications depuis l'API Jamf.
     *
     * @param array $queryParams Paramètres de requête supplémentaires.
     * @return mixed La réponse de l'API, généralement un tableau ou un objet.
     * @throws Exception
     */
    public function getApps(array $queryParams = []): mixed
    {
        return $this->client->get('/apps', $queryParams);
    }

    /**
     * Récupère tous les appareils depuis l'API Jamf.
     *
     * @param array $queryParams Paramètres de requête supplémentaires.
     * @return mixed La réponse de l'API, généralement un tableau ou un objet.
     * @throws Exception
     */
    public function getDevices(array $queryParams = []): mixed
    {
        return $this->client->get('/devices', $queryParams);
    }

    /**
     * Effectue une requête GET générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint (par exemple, '/devices' ou '/users/1').
     * @param array $queryParams Paramètres de requête supplémentaires.
     * @return mixed La réponse de l'API.
     * @throws Exception
     */
    public function get(string $path, array $queryParams = []): mixed
    {
        return $this->client->get($path, $queryParams);
    }

    /**
     * Effectue une requête POST générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint.
     * @param mixed $data Les données à envoyer dans le corps de la requête.
     * @return mixed La réponse de l'API.
     * @throws Exception
     */
    public function post(string $path, mixed $data): mixed
    {
        return $this->client->post($path, $data);
    }

    /**
     * Effectue une requête PUT générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint.
     * @param mixed $data Les données à envoyer dans le corps de la requête.
     * @return mixed La réponse de l'API.
     * @throws Exception
     */
    public function put(string $path, mixed $data): mixed
    {
        return $this->client->put($path, $data);
    }

    /**
     * Effectue une requête DELETE générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint à supprimer.
     * @return mixed La réponse de l'API.
     * @throws Exception
     */
    public function delete(string $path): mixed
    {
        return $this->client->delete($path);
    }
}