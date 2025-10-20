# 🚀 PHP Jamf Api

Une bibliothèque PHP simple pour interagir avec l'API de Jamf (apiv6.zuludesk.com), basée sur une classe `ApiClient` générique.

---

## 🛠️ Installation

Cette bibliothèque est conçue pour être facilement installable via Composer.

1.  **Exigence :** Assurez-vous d'avoir [Composer](https://getcomposer.org/) installé sur votre système.
2.  **Ajoutez la dépendance** à votre projet via Composer :

    ```bash
    composer require beriyack/jamfapi
    ```

    Cela installera la librairie dans votre dossier `vendor/` et mettra à jour l'autoloader de Composer.

3.  **Utilisez l'autoloader de Composer** dans votre projet :

    ```php
    <?php
    require_once 'vendor/autoload.php';

    use Beriyack\JamfAPI;
    ?>
    ```

---

## 📖 Utilisation

Après l'installation via Composer, vous devez instancier la classe `JamfApi`.

### Exemple de code

```php
<?php

require_once __DIR__ . '/vendor/autoload.php'; // Inclut l'autoloader de Composer

use Beriyack\JamfApi;

// Vos identifiants Jamf
$networkId = 'VOTRE_NETWORK_ID'; // Remplacez par votre Network ID Jamf
$key = 'VOTRE_CLE_API';         // Remplacez par votre clé d'API Jamf
// Avec le certificat pour l'environnemnt de développement local
// Pour l'environnement de production, le certificat n'est pas nécessaire
$caCertPath = __DIR__ . '/Amazon Root CA 1.crt'; // Chemin absolu vers votre fichier .crt

// Assurez-vous que le fichier de certificat existe
if (!file_exists($caCertPath)) {
    die("Erreur: Le fichier de certificat CA n'a pas été trouvé à l'emplacement: " . $caCertPath);
}

try {
    // Instanciez la bibliothèque JamfApi
    $jamf = new JamfApi($networkId, $key, $caCertPath);

    // --- Exemple 1: Récupérer toutes les applications ---
    echo "Récupération des applications...\n";
    $apps = $jamf->getApps();

    if ($apps) {
        echo "Applications trouvées:\n";
        print_r($apps);
    } else {
        echo "Aucune application trouvée ou erreur lors de la récupération.\n";
    }

    echo "\n";

    // --- Exemple 2: Requête GET générique pour un autre endpoint (si disponible) ---
    // Supposons un endpoint '/devices' existe et retourne des données
    echo "Récupération des appareils...\n";
    $devices = $jamf->get('/devices');
    if ($devices) {
        echo "Appareils trouvés:\n";
        print_r($devices);
    } else {
        echo "Aucun appareil trouvé ou erreur lors de la récupération.\n";
    }
} catch (Exception $e) {
    echo "Une erreur est survenue : " . $e->getMessage() . "\n";
}

?>
```

---

## 🤝 Contribution

Les contributions sont les bienvenues \! Si vous avez des idées d'améliorations, de nouvelles fonctionnalités ou des corrections de bugs, n'hésitez pas à ouvrir une *issue* ou à soumettre une *pull request*.

---

## 📄 Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](https://www.google.com/search?q=LICENSE) pour plus de détails.

-----

## 📧 Contact

Pour toute question ou suggestion, vous pouvez me contacter via [Beriyack](https://github.com/Beriyack).

-----