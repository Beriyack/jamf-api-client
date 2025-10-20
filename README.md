# 🚀 Jamf API Client for PHP

Une bibliothèque PHP pour interagir avec l'API de Jamf (apiv6.zuludesk.com). Elle est construite sur le client HTTP générique `beriyack/api-client` pour fournir des méthodes spécifiques à Jamf.

---

## 🛠️ Installation

Cette bibliothèque est conçue pour être facilement installable via Composer.

1.  **Exigence :** Assurez-vous d'avoir Composer installé sur votre système.
2.  **Ajoutez la dépendance** à votre projet via Composer :

    ```bash
    composer require beriyack/jamf-api-client
    ```

    Cela installera la librairie dans votre dossier `vendor/` et mettra à jour l'autoloader de Composer.

3.  **Utilisez l'autoloader de Composer** dans votre projet :

    ```php
    <?php
    require_once 'vendor/autoload.php';

    use Beriyack\Jamf\JamfApiClient;
    ?>
    ```

---

## 📖 Utilisation

Après l'installation via Composer, vous devez instancier la classe `JamfApiClient`.

### Exemple de code

Le client est configuré lors de son instanciation avec vos identifiants et, si nécessaire, un certificat SSL.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php'; // Inclut l'autoloader de Composer

use Beriyack\Jamf\JamfApiClient;
use Exception;

// Vos identifiants Jamf
$networkId = 'VOTRE_NETWORK_ID'; // Remplacez par votre Network ID Jamf
$key = 'VOTRE_CLE_API';         // Remplacez par votre clé d'API Jamf

// Optionnel : Chemin vers votre certificat CA pour un environnement de développement local.
// Laissez `null` si vous êtes en production ou si votre système a déjà les bons certificats.
$caCertPath = __DIR__ . '/path/to/your/Amazon Root CA 1.crt';

try {
    // Instanciez le client Jamf
    // Le constructeur vérifiera si le fichier de certificat existe.
    $jamf = new JamfApiClient($networkId, $key, $caCertPath);

    // --- Exemple 1: Récupérer toutes les applications ---
    echo "Récupération des applications...\n";
    $apps = $jamf->getApps();
    print_r($apps);

    echo "\n";

    // --- Exemple 2: Récupérer tous les appareils ---
    echo "Récupération des appareils...\n";
    $devices = $jamf->getDevices();
    print_r($devices);

} catch (Exception $e) {
    echo "Une erreur est survenue : " . $e->getMessage() . "\n";
}

?>
```

### Opérations CRUD génériques

En plus des méthodes spécifiques comme `getApps()`, le client expose les méthodes `get`, `post`, `put`, et `delete` pour interagir avec n'importe quel endpoint de l'API.

```php
try {
    // Créer une nouvelle ressource (ex: un appareil)
    $newDeviceData = ['name' => 'Nouveau iPad', 'asset_tag' => '12345'];
    $createdDevice = $jamf->post('/devices', $newDeviceData);
    echo "Appareil créé avec l'ID : " . $createdDevice['id'] . "\n";

    // Mettre à jour cette ressource
    $updatedData = ['name' => 'iPad de la salle de conférence'];
    $jamf->put('/devices/' . $createdDevice['id'], $updatedData);
    echo "Appareil mis à jour.\n";

    // Supprimer la ressource
    $jamf->delete('/devices/' . $createdDevice['id']);
    echo "Appareil supprimé.\n";
} catch (Exception $e) {
    echo "Une erreur CRUD est survenue : " . $e->getMessage() . "\n";
}
```
---

## 🤝 Contribution

Les contributions sont les bienvenues \! Si vous avez des idées d'améliorations, de nouvelles fonctionnalités ou des corrections de bugs, n'hésitez pas à ouvrir une *issue* ou à soumettre une *pull request*.

---

## 📄 Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](./LICENSE) pour plus de détails.

-----

## 📧 Contact

Pour toute question ou suggestion, vous pouvez me contacter via [Beriyack](https://github.com/Beriyack).

-----