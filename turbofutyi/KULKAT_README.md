# KÜLKAT Frontend - Angular

Különleges Lények Katasztere (Special Creatures Registry) - Angular Frontend Application

## 🦄 Projekt leírása

Ez egy hivatalos nyilvántartó rendszer frontend alkalmazása, amely különleges, ritka, néha mágikus lényeket, tárgyakat és jelenségeket tart számon. Az alkalmazás lehetővé teszi a felhasználók számára, hogy lényeket létrehozzanak, kategorizáljanak, képességekkel lássák el, galériát töltsenek fel hozzájuk, és kapcsolatfelvételi üzeneteket fogadjanak.

## 🚀 Technológiák

- **Angular 20.2** - Modern Angular framework standalone komponensekkel
- **TypeScript 5.9** - Type-safe fejlesztés
- **RxJS 7.8** - Reaktív programozás
- **Angular Signals** - Reaktív állapotkezelés
- **Reactive Forms** - Űrlapkezelés
- **HttpClient** - API kommunikáció interceptorokkal
- **CSS Grid & Flexbox** - Modern reszponzív layout

## 📋 Funkciók

### 🔐 Authentikáció
- Bejelentkezési oldal form validációval
- Bearer token alapú authentikáció
- Automatikus token kezelés HTTP interceptorral
- Védett route-ok auth guard-al
- Token tárolás localStorage-ban

### 🦄 Lények kezelése
- Összes lény listázása
- Lény részletek megtekintése
- Új lény létrehozása
- Lény szerkesztése
- Lény törlése megerősítéssel
- Kategória hozzárendelés

### ⚡ Képességek kezelése
- Képességek hozzáadása lényekhez modális ablakban
- Képességek eltávolítása
- Lény képességeinek megjelenítése

### 🖼️ Galéria kezelése
- Képek megtekintése grid elrendezésben
- Új képek feltöltése
- Lightbox a teljes méretű képek megtekintéséhez
- Fájl validáció (típus és méret)

### 📧 Kapcsolatfelvétel
- Reactive form átfogó validációval
- Sikeres/hibaüzenetek
- Email és üzenet validáció

### 🎨 UI/UX
- Reszponzív design (mobil, tablet, desktop)
- Modern gradient színsémával (lila/kék)
- Betöltés indikátorok
- Hibaüzenetek kezelése
- Breadcrumb navigáció
- Emoji ikonok
- Simán animációk

## 🔧 Telepítés

### Előfeltételek

- Node.js (v18+)
- npm (v9+)
- Angular CLI (`npm install -g @angular/cli`)

### Lépések

1. **Repository klónozása**
```bash
git clone https://github.com/1tc-borpet/enmegjomagam1.git
cd enmegjomagam1/turbofutyi
```

2. **Függőségek telepítése**
```bash
npm install
```

3. **Környezeti változók beállítása**

Szerkessze a `src/environments/environment.ts` fájlt az API URL megfelelő beállításával:

```typescript
export const environment = {
  production: false,
  apiUrl: 'http://localhost:8000/api'  // Laravel backend URL
};
```

4. **Fejlesztői szerver indítása**
```bash
npm start
# vagy
ng serve
```

Az alkalmazás elérhető lesz a `http://localhost:4200/` címen.

## 🏗️ Build

### Fejlesztői build
```bash
npm run build
```

### Produkciós build
```bash
ng build --configuration production
```

A build output a `dist/turbofutyi` mappában található.

## 📁 Projekt struktúra

```
src/
├── app/
│   ├── components/
│   │   ├── auth/
│   │   │   ├── login.component.ts
│   │   │   ├── login.component.html
│   │   │   └── login.component.css
│   │   ├── creatures/
│   │   │   ├── creatures-list.component.*
│   │   │   ├── creature-detail.component.*
│   │   │   ├── creature-form.component.*
│   │   │   └── creature-gallery.component.*
│   │   ├── contact/
│   │   │   └── contact.component.*
│   │   └── layout/
│   │       └── layout.component.*
│   ├── services/
│   │   ├── auth.service.ts
│   │   ├── creature.service.ts
│   │   ├── category.service.ts
│   │   ├── ability.service.ts
│   │   └── contact.service.ts
│   ├── models/
│   │   ├── user.model.ts
│   │   ├── creature.model.ts
│   │   ├── category.model.ts
│   │   ├── ability.model.ts
│   │   └── contact.model.ts
│   ├── guards/
│   │   └── auth.guard.ts
│   ├── interceptors/
│   │   └── auth.interceptor.ts
│   ├── app.config.ts
│   ├── app.routes.ts
│   └── app.ts
├── environments/
│   ├── environment.ts
│   └── environment.prod.ts
└── styles.css
```

## 🛣️ Route-ok

| Route | Komponens | Védelem | Leírás |
|-------|-----------|---------|---------|
| `/login` | LoginComponent | - | Bejelentkezési oldal |
| `/creatures` | CreaturesListComponent | ✅ | Lények listája |
| `/creatures/new` | CreatureFormComponent | ✅ | Új lény létrehozása |
| `/creatures/:id` | CreatureDetailComponent | ✅ | Lény részletei |
| `/creatures/:id/edit` | CreatureFormComponent | ✅ | Lény szerkesztése |
| `/creatures/:id/gallery` | CreatureGalleryComponent | ✅ | Lény galériája |
| `/contact` | ContactComponent | ✅ | Kapcsolatfelvétel |

## 🔌 API Végpontok

Az alkalmazás a következő Laravel backend végpontokat használja:

### Authentikáció
- `POST /api/login` - Bejelentkezés
- `POST /api/logout` - Kijelentkezés

### Lények
- `GET /api/creatures` - Összes lény lekérése
- `GET /api/creatures/{id}` - Egy lény lekérése
- `POST /api/creatures` - Lény létrehozása
- `PUT /api/creatures/{id}` - Lény frissítése
- `DELETE /api/creatures/{id}` - Lény törlése

### Képességek
- `GET /api/abilities` - Összes képesség lekérése
- `POST /api/creatures/{id}/abilities` - Képesség hozzáadása
- `DELETE /api/creatures/{id}/abilities/{abilityId}` - Képesség eltávolítása

### Kategóriák
- `GET /api/categories` - Összes kategória lekérése

### Galéria
- `GET /api/creatures/{id}/gallery` - Lény képeinek lekérése
- `POST /api/creatures/{id}/gallery` - Kép feltöltése

### Kapcsolat
- `POST /api/contact` - Kapcsolatfelvételi üzenet küldése

## 🧪 Tesztelés

```bash
npm test
```

## 📝 Fejlesztési jegyzetek

### Standalone Components
Az alkalmazás Angular 20 standalone komponenseket használ, ami egyszerűbb modulkezelést tesz lehetővé.

### Signals
Az állapotkezelés Angular Signals API-val történik, ami reaktív és performáns.

### Lazy Loading
A route-ok lazy loading-ot használnak az optimális teljesítmény érdekében.

### HTTP Interceptor
Az `authInterceptor` automatikusan hozzáadja a Bearer tokent minden API híváshoz.

### Form Validation
Minden űrlap átfogó validációval rendelkezik és felhasználóbarát hibaüzenetekkel.

## 🎨 Dizájn rendszer

### Színséma
- Elsődleges: `#667eea` → `#764ba2` (gradient)
- Háttér: `#f8f9fa`
- Szöveg: `#333`
- Hiba: `#ef4444`
- Siker: `#4caf50`

### Tipográfia
- Rendszer font stack: `-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell`

## 🤝 Csapatmunka

Ez a projekt egy backend és frontend fejlesztő közös munkája:
- **Backend**: Laravel API implementáció
- **Frontend**: Angular alkalmazás (ez a projekt)

## 📄 Licenc

MIT License

## 👥 Szerzők

KÜLKAT Fejlesztő Csapat - 2024

---

**Megjegyzés**: Ez egy gyakorló projektfeladat a „Különleges Lények Katasztere" nyilvántartó rendszerhez.
