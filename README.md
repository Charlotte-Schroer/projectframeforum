

# FrameForum 🎬

Een filmforum website waar gebruikers kunnen discussiëren over films, nieuws kunnen lezen en vragen kunnen stellen.

## Over dit project

FrameForum is mijn project voor Backend Web. Het idee voor dit concrete onderwerp is een gevolg van de opdracht zelf. De website combineert een nieuwssectie met een interactief forum.

## Wat kan je ermee?

**Voor iedereen:**
- Filmnieuws lezen
- Forum topics bekijken
- FAQ raadplegen
- Gebruikersprofielen bekijken
- Contactformulier gebruiken

**Voor geregistreerde gebruikers:**
- Je eigen profiel aanmaken en personaliseren
- Forum topics starten
- Reageren op discussies
- Profielfoto uploaden

**Voor admins:**
- Nieuwtjes publiceren en beheren
- FAQ items toevoegen
- Contact berichten bekijken
- Gebruikers admin rechten geven

## Installeren

### Je hebt nodig:
- PHP 8.1+
- MySQL
- Composer
- Node.js

### Setup:

```bash
# Installeer alles
composer install
npm install

# Maak je .env bestand
cp .env.example .env
php artisan key:generate

# Vul je database gegevens in .env in
# DB_DATABASE=frameforum
# DB_USERNAME=root
# DB_PASSWORD=

# Database opzetten
php artisan migrate:fresh --seed

# CSS builden
npm run build

# Starten
php artisan serve
```

Surf naar `http://localhost:8000`

## Inloggen

Na de installatie kan je inloggen met:
- Email: `admin@ehb.be`
- Wachtwoord: `Password!321`

## Tech stack

- Laravel 12.40.1
- MySQL database
- Tailwind CSS voor styling
- Laravel Breeze voor authenticatie
- Alpine.js voor interactiviteit

## Database opbouw

![img.png](docs/img.png)

De belangrijkste tabellen:
- Users met admin functionaliteit
- News voor artikelen
- Topics en Posts voor het forum
- Tags voor filmgenres (many-to-many met topics)
- FAQ Categories en Items
- Contact Messages

## Features checklist

**Verplichte onderdelen:**
- [x] Login/registratie systeem
- [x] Admin en user rollen
- [x] Profielpagina's
- [x] Nieuws CRUD
- [x] FAQ pagina
- [x] Contact formulier met email

**Extra's:**
- [x] Forum met topics en replies
- [x] Tags systeem
- [x] Dark mode
- [ ] Admin dashboard (work in progress)

## Problemen die ik tegenkwam



## Credits & Bronvermelding

### Ontwikkeling

**Student:** Charlotte Schröer  
**Academiejaar:** 2025-2026
**Vak:** Backend Web

### Documentatie

- [Laravel Documentation](https://laravel.com/docs) - Framework documentatie & Blade templating
- [Tailwind CSS Documentation](https://tailwindcss.com/docs) - Styling
- Cursusmateriaal Backend Web - EHB

### Hulpmiddelen

- ChatGPT: 
  - Creatie NewsSeeder.php
  - Ontwerp logo FrameForum
- Claude AI:
  - Code suggesties
  - Debugging ondersteuning


## To-do

Als ik meer tijd had zou ik nog graag toevoegen:
- 





---

Gemaakt als schoolproject voor Erasmushogeschool Brussel
