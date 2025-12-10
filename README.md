# 🦄 KÜLKAT - Különleges Lények Katasztere

Egy hivatalos nyilvántartó rendszer különleges, ritka, mágikus lények, tárgyak és jelenségek számon tartására.

## 🛠️ Technológiák

### Backend
- Laravel 12
- Laravel Sanctum (Bearer Token Auth)
- MySQL/PostgreSQL

### Frontend (Angular - külön repository)
- Angular 17+
- TypeScript
- Reactive Forms

## 📋 Rendszer követelmények

- PHP >= 8.2
- Composer
- MySQL >= 8.0 vagy PostgreSQL
- Node.js >= 18.x (npm)

## 🚀 Telepítési lépések

### Backend (Laravel)

1. **Clone repository**
```bash
git clone https://github.com/1tc-borpet/enmegjomagam1.git
cd enmegjomagam1/enmegjomagam
```

2. **Függőségek telepítése**
```bash
composer install
```

3. **Environment beállítása**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Adatbázis konfiguráció**
Szerkeszd a `.env` fájlt:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kulkat
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrációk futtatása**
```bash
php artisan migrate
```

6. **Szerver indítása**
```bash
php artisan serve
```

API elérhető: `http://localhost:8000/api`

---

## 🌐 API Dokumentáció

### Base URL
```
http://localhost:8000/api
```

### Authentikáció

#### Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@kulkat.hu",
  "password": "password"
}

Response:
{
  "token": "1|xxxxxxxxxxxxxx",
  "user": { ... }
}
```

#### Logout
```http
POST /api/logout
Authorization: Bearer {token}
```

---

### Lények (Creatures)

#### Összes lény listázása
```http
GET /api/creatures

Response:
[
  {
    "id": 1,
    "nev": "Teleportáló Teve",
    "leiras": "Egy különleges teve...",
    "kategoria": { "id": 1, "nev": "Mágikus" },
    "kepessegek": [...]
  }
]
```

#### Egy lény részletei
```http
GET /api/creatures/{id}
```

#### Új lény létrehozása (védett)
```http
POST /api/creatures
Authorization: Bearer {token}
Content-Type: application/json

{
  "nev": "Hangulatváltós Kaktusz",
  "leiras": "Színt vált hangulatától függően",
  "kategoria_id": 2
}
```

#### Lény módosítása (védett)
```http
PUT /api/creatures/{id}
Authorization: Bearer {token}
```

#### Lény törlése (védett)
```http
DELETE /api/creatures/{id}
Authorization: Bearer {token}
```

---

### Képességek hozzárendelése

#### Képesség hozzáadása lényhez (védett)
```http
POST /api/creatures/{id}/abilities
Authorization: Bearer {token}
Content-Type: application/json

{
  "kepesseg_id": 3
}
```

#### Képesség eltávolítása (védett)
```http
DELETE /api/creatures/{id}/abilities/{abilityId}
Authorization: Bearer {token}
```

---

### Galéria

#### Galéria képek listázása
```http
GET /api/creatures/{id}/gallery
```

#### Kép feltöltése (védett)
```http
POST /api/creatures/{id}/gallery
Authorization: Bearer {token}
Content-Type: multipart/form-data

kep: [file]
leiras: "Képleírás"
```

---

### Kapcsolati űrlap

```http
POST /api/contact
Content-Type: application/json

{
  "nev": "Nagy Péter",
  "email": "peter@example.com",
  "uzenet": "Találtam egy furcsa lényt..."
}
```

---

## 🛢️ Adatbázis Struktúra

### Táblák (7)

1. **users** - felhasználók (adminok)
2. **lenyek** - különleges lények
3. **kategoriak** - lénykategóriák (Mágikus, Mutáns, Digitális, stb.)
4. **kepessegek** - lehetséges képességek
5. **leny_kepesseg** - N:N kapcsolótábla
6. **galeriakepek** - lény képek
7. **kapcsolati_uzenetek** - publikus kapcsolati űrlap beküldései

### Kapcsolatok (5+)

- User → Lények (1:N)
- Lény → Kategória (N:1)
- Lény → Képességek (N:N)
- Lény → Galéria (1:N)

---

## 👥 Csapat

- **Backend fejlesztő**: Laravel API, adatbázis, authentikáció
- **Frontend fejlesztő**: Angular SPA, UI/UX

## 📦 Branch Stratégia

- `main` - stabil verzió
- `dev` - integráció
- `backend/*` - backend fejlesztési ágak
- `frontend/*` - frontend fejlesztési ágak

## 📄 Licenc

Gyakorló projekt - ITC Kecskemét
