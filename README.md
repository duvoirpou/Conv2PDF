# Conv2PDF

Ce projet Laravel permet principalement de télécharger et de convertir des fichiers (Word, Excel, LibreOffice, etc.) en format PDF. Le fichier est converti sur le serveur, puis téléchargé automatiquement par l'utilisateur. Les fichiers sont ensuite supprimés du serveur après la conversion. D'autres fonctionnalités pourront être ajoutées si besoin

## Fonctionnalités principales

-   **Télécharger des fichiers** de types variés (Word, Excel, LibreOffice, etc.).
-   **Conversion automatique** des fichiers en format PDF.
-   **Téléchargement immédiat** du fichier PDF.
-   **Suppression des fichiers** après téléchargement pour éviter l'accumulation.
-   **Fusion des PDF** Fusionner plusieurs PDF.

## Packages installés

-   `laravel/framework` : ^11.9 (Le framework principal Laravel pour le développement web.)
-   `dompdf/dompdf` : ^3.0 (Générateur de PDF pour la conversion de fichiers)
-   `laravel/tinker` : ^2.9 (Outil de ligne de commande pour interagir avec l'application Laravel.)
-   `mpdf/mpdf` : ^8.2 (Générateur de PDF pour la conversion de fichiers.)
-   `phpoffice/phpword` : ^1.3 (Pour la manipulation de fichiers Word.)
-   `spatie/browsershot` : ^5.0 (Pour la conversion de fichiers en PDF.)
-   `phpoffice/phpspreadsheet` : ^4.1 (Pour la manipulation de fichiers Excel.)
-   `setasign/fpdf` : ^1.8 (Générateur de PDF pour la création de fichiers PDF.)
-   `setasign/fpdi` : ^2.6 (Générateur de PDF pour l'importation de fichiers PDF.)
-   `tecnickcom/tcpdf` : ^6.8 (Générateur de PDF pour la création de fichiers PDF.)
-   `ilovepdf/ilovepdf-php` : ^1.2 (API pour la conversion de fichiers en PDF.)

## Version de PHP

-   PHP 8.2.0

---

## Installation

### 1. Cloner le projet

Clone ce dépôt sur ton environnement local.

```bash
git clone https://github.com/duvoirpou/Conv2PDF.git
```

### 2. Installer les dépendances

Installe les dépendances nécessaires pour le projet.

```bash
composer install
```

### 3. Configurer l'environnement

Crée une copie du fichier `.env.example` et renomme-le en `.env`.
bash

```bash
cp .env.example .env
```

### 4. Générer une clé d'application

Génère une clé d'application pour ton projet Laravel.

```bash
php artisan key:generate
```

### 5. Installation de LibreOffice pour la conversion de fichiers

Ce projet utilise LibreOffice pour la conversion de fichiers vers PDF. Assure-toi que LibreOffice est installé sur ton serveur ou ta machine locale.
Si tu utilises un serveur, assure-toi que LibreOffice est installé et configuré pour être utilisé par PHP.

Linux (Ubuntu/Debian) :

```bash
sudo apt install libreoffice
```

Windows :

Télécharge et installe LibreOffice depuis le site officiel.

### 6. Installer les packages pour la fusion des PDF

Installe les packages suivants pour pouvoir fusionner des PDF :

```bash
composer require setasign/fpdf setasign/fpdi setasign/tcpdf
composer require tecnickcom/tcpdf
```

### 7. Installer iLovePDF Api - Php Library

Installe la bibliothèque PHP pour l'API iLovePDF (je l'utilise pour compresser les PDF) :

```bash
composer require ilovepdf/ilovepdf-php
```

### 8. Serveur de développement

Lance le serveur de développement pour accéder à l'application :

```bash
php artisan serve
```

---
