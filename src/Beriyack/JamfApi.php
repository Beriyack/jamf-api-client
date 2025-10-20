<?php

namespace Beriyack;

use Beriyack\ApiClient;

class JamfApi
{
    const BASE_URL = 'https://apiv6.zuludesk.com';

    private $networkId;
    private $key;
    private $caCertPath;

    /**
     * Constructeur de la classe JamfApi.
     *
     * @param string $networkId Ton Network ID pour l'authentification.
     * @param string $key Ta clé d'API pour l'authentification.
     * @param string|null $caCertPath Le chemin vers le fichier de certificat CA (par exemple, 'Amazon Root CA 1.crt').
     * Si null, cURL utilisera son magasin de certificats par défaut.
     */
    public function __construct(string $networkId, string $key, ?string $caCertPath = null)
    {
        $this->networkId = $networkId;
        $this->key = $key;
        $this->caCertPath = $caCertPath; // Peut être null
    }

    /**
     * Construit les options cURL par défaut avec l'authentification et le certificat CA (si fourni).
     *
     * @return array Les options cURL par défaut.
     */
    private function getDefaultOptions(): array
    {
        $options = [
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->networkId . ":" . $this->key,
        ];

        // Ajoute l'option CAINFO seulement si un chemin est fourni
        if ($this->caCertPath !== null) {
            $options[CURLOPT_CAINFO] = $this->caCertPath;
        }

        return $options;
    }

    /**
     * Récupère toutes les applications depuis l'API Jamf.
     *
     * @param array $options Options cURL supplémentaires qui écraseront les options par défaut (facultatif).
     * @return mixed La réponse de l'API, généralement un tableau ou un objet.
     */
    public function getApps(array $options = [])
    {
        $endpoint = self::BASE_URL . '/apps';
        $defaultOptions = $this->getDefaultOptions();
        $mergedOptions = array_replace($defaultOptions, $options);
        return ApiClient::get($endpoint, $mergedOptions);
    }

    /**
     * Récupère tout les appareils depuis l'API Jamf.
     *
     * @param array $options Options cURL supplémentaires qui écraseront les options par défaut (facultatif).
     * @return mixed La réponse de l'API, généralement un tableau ou un objet.
     */
    public function getDevices(array $options = [])
    {
        $endpoint = self::BASE_URL . '/devices';
        $defaultOptions = $this->getDefaultOptions();
        $mergedOptions = array_replace($defaultOptions, $options);
        return ApiClient::get($endpoint, $mergedOptions);
    }

    /**
     * Effectue une requête GET générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint (par exemple, '/devices' ou '/users/1').
     * @param array $options Options cURL supplémentaires qui écraseront les options par défaut (facultatif).
     * @return mixed La réponse de l'API.
     */
    public function get(string $path, array $options = [])
    {
        $endpoint = self::BASE_URL . $path;
        $defaultOptions = $this->getDefaultOptions();
        $mergedOptions = array_replace($defaultOptions, $options);
        return ApiClient::get($endpoint, $mergedOptions);
    }

    /**
     * Effectue une requête POST générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint.
     * @param array $data Les données à envoyer dans le corps de la requête.
     * @param array $options Options cURL supplémentaires qui écraseront les options par défaut (facultatif).
     * @return mixed La réponse de l'API.
     */
    public function post(string $path, array $data, array $options = [])
    {
        $endpoint = self::BASE_URL . $path;
        $defaultOptions = $this->getDefaultOptions();
        $mergedOptions = array_replace($defaultOptions, $options);
        return ApiClient::post($endpoint, $data, $mergedOptions);
    }

    /**
     * Effectue une requête PUT générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint.
     * @param array $data Les données à envoyer dans le corps de la requête.
     * @param array $options Options cURL supplémentaires qui écraseront les options par défaut (facultatif).
     * @return mixed La réponse de l'API.
     */
    public function put(string $path, array $data, array $options = [])
    {
        $endpoint = self::BASE_URL . $path;
        $defaultOptions = $this->getDefaultOptions();
        $mergedOptions = array_replace($defaultOptions, $options);
        return ApiClient::put($endpoint, $data, $mergedOptions);
    }

    /**
     * Effectue une requête DELETE générique à un endpoint de l'API Jamf.
     *
     * @param string $path Le chemin de l'endpoint.
     * @param array $options Options cURL supplémentaires qui écraseront les options par défaut (facultatif).
     * @return mixed La réponse de l'API.
     */
    public function delete(string $path, array $options = [])
    {
        $endpoint = self::BASE_URL . $path;
        $defaultOptions = $this->getDefaultOptions();
        $mergedOptions = array_replace($defaultOptions, $options);
        return ApiClient::delete($endpoint, $mergedOptions);
    }
}