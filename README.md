# Backend Web - Laravel Project

Dit project is een Laravel-gebaseerde webapplicatie ontworpen voor het beheren van nieuws, profielen, veelgestelde vragen, berichten en gebruikersauthenticatie. Het bevat zowel openbare als admin-functionaliteiten, waarmee contentbeheer en gebruikersinteractie mogelijk zijn.

## Technologieën

- **VScode**
- **Laravel**
- **Composer**
- **PHP**
- **Stripe**

## Inhoudsopgave

1. [Functionaliteiten](#functionaliteiten)
2. [Installatieproces](#installatieproces)
3. [Migratie- en Seederproces](#migratie--en-seederproces)
4. [Gebruik](#gebruik)
5. [Bronnen](#bronnen)
6. [Licentie](#licentie)

---

## Functionaliteiten

### **Gebruikersfunctionaliteiten (User Capabilities)**

- **Gebruikersauthenticatie**:
  - Registreren, inloggen en uitloggen.
  - Wachtwoord resetten via e-mail (indien vergeten).
- **Gebruikers**:
  - Zie alle gebruikers
  - Zie een gebruiker zijn profiel

- **Nieuws en reacties**:
  - Bekijk nieuwsartikelen.
  - Reageer op nieuwsitems.
  - Bekijk en reageer op reacties van andere gebruikers.

- **FAQ (Veelgestelde vragen)**:
  - Bekijk veelgestelde vragen.
  - Zoek door FAQ-items om snel antwoorden te vinden.

- **Contactformulier**:
  - Vul een formulier in om contact op te nemen.

- **Profielbeheer**:
  - Bekijk en bewerk persoonlijke gegevens (zoals naam, e-mail, wachtwoord, adress).
  - Bekijk bestelgeschiedenis en volg huidige bestellingen.

- **Winkel en betalingen**:
  - Blader door producten in de webshop.
  - Voeg producten toe aan de winkelwagen.
  - Werk de winkelwagen bij (producten verwijderen of aantallen aanpassen).
  - Betaal voor bestellingen via Stripe.
  - Volg de status van bestellingen (bijv. in behandeling, verzonden, geleverd).

---

### **Beheerfunctionaliteiten (Admin Capabilities)**

- **Gebruikersbeheer**:
  - Bekijk alle geregistreerde gebruikers.
  - Verwijder ongewenste of inactieve gebruikers.
  - Pas gegevens van gebruikers aan (zoals e-mail, wachtwoord of naam).

- **Nieuwsbeheer**:
  - Voeg nieuwe nieuwsartikelen toe.
  - Bewerk bestaande nieuwsartikelen.
  - Verwijder ongewenste of verouderde nieuwsartikelen.

- **FAQ Beheer**:
  - Voeg veelgestelde vragen toe.
  - Voeg, verwijder categorien
  - Bewerk bestaande FAQ-items.
  - Verwijder verouderde of irrelevante FAQ-items.

- **Productbeheer (Webshop)**:
  - Voeg nieuwe producten toe, inclusief afbeeldingen, beschrijving, prijs en voorraad.
  - Bewerk bestaande producten.
  - Verwijder producten die niet meer beschikbaar zijn.
  - Beheer voorraad en houd deze up-to-date.

- **Bestellingen Beheren**:
  - Bekijk alle bestellingen van gebruikers.
  - Wijzig de status van een bestelling (bijv. in behandeling, verzonden, geleverd).

- **Reacties**:
  - Bekijk en verwijder ongepaste reacties of posts.

- **Contactbeheer**:
  - Bekijk en beantwoord berichten van gebruikers via het contactformulier.
---



## Installatieproces

Volg de onderstaande stappen om het project op je lokale omgeving op te zetten:

1. **Kloon de repository**:
   ```bash
   git clone https://github.com/JornDeSmet/backendwebproject.git
   ```

2. **Installeer afhankelijkheden**:
   ```bash
   composer install
   npm install && npm run dev
   ```
   laat deze openstaan zodanig dat het project kan werken.
3. **Open een andere ubuntu cli**:
   ```bash
   cd backendwebproject
   ```

4. **Stel het `.env`-bestand in**:
   Maak een `.env`-bestand in de rootdirectory en kopieer de inhoud van `.env.example`:
   ```bash
   cp .env.example .env
   ```

5. **Genereer de applicatiesleutel**:
   ```bash
   php artisan key:generate
   ```

6. **Link de storage**:
   ```bash
   php artisan storage:link
   ```

7. **Stel de database in**:
   - Maak een MySQL-database lokaal aan (bijv. `backendweb_laravel`).
   - Update het `.env`-bestand met je databasegegevens:
     ```
     DB_CONNECTION=je_soort_database
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=backendweb_laravel
     DB_USERNAME=je_database_gebruiker
     DB_PASSWORD=je_database_wachtwoord
     ```

8. **Configureer de e-mailservice**:
   - Update het `.env`-bestand met je e-mailservicegegevens:
     ```
     MAIL_MAILER=smtp
     MAIL_HOST=je_mail_host
     MAIL_PORT=587
     MAIL_USERNAME=je_mail_gebruiker
     MAIL_PASSWORD=je_mail_wachtwoord
     MAIL_ENCRYPTION=tls
     MAIL_FROM_ADDRESS=noreply@example.com
     MAIL_FROM_NAME="Laravel App"
     ```
9. **Je Stripe public en private key**
   - Update het `.env`-bestand met je stripegegevens:
     ```
     STRIPE_KEY = je_stripe_public_key
     STRIPE_SECRET = je_stripe_private_key
     ```
---

## Migratie- en Seederproces

1. ***Ga naar je project*
      ```bash
       cd backendwebproject
       ```
2. **Voer migraties uit**:
   ```bash
   php artisan migrate
   ```

3. **Seed de database**:
   Het project bevat seeders om de database te vullen met initiële gegevens:
   ```bash
   php artisan db:seed
   ```

4. **Combineer migratie en seeding (optioneel)**:
   ```bash
   php artisan migrate --seed
   ```
---

## Gebruik

1. **Start de ontwikkelserver**:
   ```bash
   php artisan serve
   ```

2. **Toegang tot de applicatie**:
   Open je browser en ga naar [http://127.0.0.1:8000](http://127.0.0.1:8000).

3. **Admin toegang**:
   - Standaard wordt een admin-gebruiker ge-seed in de database:
     - **E-mail**: `admin@ehb.be`
     - **Wachtwoord**: `Password!321`

4. **Openbare toegang**:
   - Gebruikers kunnen zich registreren of inloggen om toegang te krijgen tot profiel- en nieuwsfunctionaliteiten.

---

## Bronnen

- [Laravel-documentatie](https://laravel.com/docs)
- [Composer-documentatie](https://getcomposer.org/doc/)
- [Node.js en NPM](https://nodejs.org/)
- [PHP Documentatie](https://www.php.net/manual/en/)

---

## Licentie

Dit project is beschikbaar onder de [MIT-licentie](https://opensource.org/licenses/MIT).
